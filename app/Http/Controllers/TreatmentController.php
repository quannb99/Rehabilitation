<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TreatmentRepository;
use App\Repositories\UserRepository;
use App\Repositories\MedicalRecordRepository;

class TreatmentController extends Controller
{
    protected $treatmentRepository;
    protected $userRepository;
    protected $medicalRecordRepository;

    public function __construct(
        TreatmentRepository $treatmentRepository,
        UserRepository $userRepository,
        MedicalRecordRepository $medicalRecordRepository
    ) {
        $this->treatmentRepository = $treatmentRepository;
        $this->userRepository = $userRepository;
        $this->medicalRecordRepository = $medicalRecordRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request['id'] ?? '';
        $userId = $request['user_id'] ?? '';
        $titleQuery = $request['titleQuery'] ?? '';
        $includeShared = $request['includeShared'] ?? '';

        $query = $this->treatmentRepository->getCollection($request);

        if ($id) {
            $query->where('id', $id);
        }

        if ($userId && !$includeShared) {
            $query->where('user_id', $userId);
        }

        if ($includeShared) {
            $query->where(function ($row) use ($userId) {
                $row->where('user_id', $userId)->orWhere('privacy', 1);
            });
        }

        if ($titleQuery) {
            $query->where('title', 'like', '%' . $titleQuery . '%');
        }

        $items = $query->orderByDesc('created_at')->paginate(5);
        $items->map(function ($item) {
            $item->user_name = $this->userRepository->detail($item->user_id)->name;
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
            $item = $this->treatmentRepository->create($request->all());
        } catch (\Exception $e) {
            return $this->sendError('Vui lòng thử lại', $e->getMessage(), 'Có lỗi xảy ra');
        }

        return $this->sendSuccess($item->id);
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
            $this->treatmentRepository->update($request->all(), $id);
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
            $this->treatmentRepository->delete($id);
        } catch (\Exception $e) {
            return $this->sendError('Vui lòng thử lại', $e->getMessage(), 'Có lỗi xảy ra');
        }

        return $this->sendSuccess('');
    }
}
