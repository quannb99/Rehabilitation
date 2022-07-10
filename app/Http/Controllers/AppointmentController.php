<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\BookAppointment;
use Illuminate\Http\Request;
use App\Repositories\AppointmentRepository;
use Illuminate\Support\Facades\Notification;

class AppointmentController extends Controller
{
    protected $appointmentRepository;

    public function __construct(
        AppointmentRepository $appointmentRepository
    ) {
        $this->appointmentRepository = $appointmentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request['id'] ?? '';
        $start = $request['start_at'] ?? '';
        $end = $request['end_at'] ?? '';
        $doctorId = $request['doctor_id'] ?? '';
        $userId = $request['userId'] ?? '';
        $doctorNameQuery = $request['doctorNameQuery'] ?? '';

        if ($userId) {
            $items = $this->appointmentRepository->getCollection($request)
                ->where('user_id', $userId)
                ->select([
                    'appointments.*',
                    'users.name as doctor_name',
                ])
                ->leftJoin('users', 'appointments.doctor_id', 'users.id');
            if ($doctorNameQuery) {
                $items->where('users.name', 'like', '%' . $doctorNameQuery . '%');
            }

            $res = $items->orderByDesc('created_at')->paginate(5);
            return $this->sendSuccess($res);
        }

        $query = $this->appointmentRepository->getCollection($request)
            ->select([
                'appointments.*',
                'users.name as user_name',
                'users.avatar as user_avatar',
            ])
            ->leftJoin('users', 'appointments.user_id', 'users.id')
            ->where('doctor_id', $doctorId)
            ->where('start_at', $start)
            ->where('end_at', $end);

        $items = $query->orderBy('created_at')->paginate(5);

        return $this->sendSuccess($items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $appointment = $this->appointmentRepository->create($request->all());
            $doctor = User::find($request['doctor_id']);
            $user = User::find($request['user_id']);
            Notification::send($doctor, new BookAppointment($user, $appointment));
        } catch (\Exception $e) {
            return $this->sendError('Vui lòng thử lại', $e->getMessage(), 'Có lỗi xảy ra');
        }

        return $this->sendSuccess('');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('common');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('common');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $post = $this->appointmentRepository->update($request->all(), $id);
        } catch (\Exception $e) {
            return $this->sendError('Vui lòng nhập đủ các trường', 'Kiểm tra lại');
        }

        return $this->sendSuccess('');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->appointmentRepository->delete($id);
        } catch (\Exception $e) {
            return $this->sendError('Vui lòng thử lại', $e->getMessage(), 'Có lỗi xảy ra');
        }

        return $this->sendSuccess('');
    }
}
