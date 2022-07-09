<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\CallRepository;
use Illuminate\Support\Facades\Auth;

class CallController extends Controller
{
    protected $userRepository;
    protected $callRepository;

    public function __construct(
        UserRepository $userRepository,
        CallRepository $callRepository
    ) {
        $this->callRepository = $callRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request['id'] ?? '';
        $start_at = $request['start_at'] ?? '';
        $end_at = $request['end_at'] ?? '';
        $doctor_id = $request['doctor_id'] ?? '';
        $status = $request['status'] ?? '';
        $query = $this->callRepository->getCollection($request)
            ->where(function ($row) use ($doctor_id) {
                $row->where('user_a_id', $doctor_id)->orWhere('user_b_id', $doctor_id);
            })
            ->where('created_at', '>=', $start_at)
            ->where('created_at', '<=', $end_at)
            ->where('status', $status);


        $items = $query->orderByDesc('created_at')->paginate(5);

        $items->map(function ($item) {
            $item->user_a = User::where('id', $item->user_a_id)->get(['name', 'avatar'])->first();
            $item->user_b = User::where('id', $item->user_b_id)->get(['name', 'avatar'])->first();
        });

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
            $user = Auth::user();
            $message = $this->callRepository->create($request->all());
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
            $post = $this->callRepository->update($request->all(), $id);
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
            $this->callRepository->delete($id);
        } catch (\Exception $e) {
            return $this->sendError('Vui lòng thử lại', $e->getMessage(), 'Có lỗi xảy ra');
        }

        return $this->sendSuccess('');
    }
}
