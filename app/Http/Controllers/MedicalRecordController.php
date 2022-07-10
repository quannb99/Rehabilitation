<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use App\Repositories\MedicalRecordRepository;
use App\Repositories\UserRepository;
use App\Repositories\RecordTreatmentRepository;
use App\Repositories\TreatmentRepository;

class MedicalRecordController extends Controller
{
    protected $medicalRecordRepository;
    protected $userRepository;
    protected $recordTreatmentRepository;
    protected $treatmentRepository;

    public function __construct(
        MedicalRecordRepository $medicalRecordRepository,
        UserRepository $userRepository,
        RecordTreatmentRepository $recordTreatmentRepository,
        TreatmentRepository $treatmentRepository
    ) {
        $this->medicalRecordRepository = $medicalRecordRepository;
        $this->userRepository = $userRepository;
        $this->recordTreatmentRepository = $recordTreatmentRepository;
        $this->treatmentRepository = $treatmentRepository;
    }

    public function recordTreatments(Request $request)
    {
        $delete = $request['delete'] ?? '';
        $get = $request['get'] ?? '';
        $record_id = $request['record_id'] ?? '';
        $treatment_id = $request['treatment_id'] ?? '';
        try {
            if ($get) {
                // $treatmentRecords = $this->recordTreatmentRepository->getCollection('')->orderBy('created_at')->get();
                // $treatmentIds = $treatmentRecords->map(function ($item) {
                //     return $item->treatment_id;
                // });

                // $items = $this->treatmentRepository->getCollection('')->whereIn('id', $treatmentIds)->get();
                // $items->map(function ($item) {
                //     $item->user_name = $this->userRepository->detail($item->user_id)->name;
                // });
                $record = MedicalRecord::find($record_id);
                $treatments = $record->treatments()->orderByDesc('created_at')->get();
                return $this->sendSuccess($treatments);
            }
            if ($delete) {
                $id = $this->recordTreatmentRepository->getCollection('')
                    ->where('record_id', $record_id)
                    ->where('treatment_id', $treatment_id)
                    ->first()->id;
                $this->recordTreatmentRepository->delete($id);
                return $this->sendSuccess('');
            }
            $item = $this->recordTreatmentRepository->create($request->all());
        } catch (\Exception $e) {
            return $this->sendError('Vui lòng thử lại', $e->getMessage(), 'Có lỗi xảy ra');
        }

        return $this->sendSuccess($item->id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request['id'] ?? '';
        $user_id = $request['user_id'] ?? '';
        $doctor_id = $request['doctor_id'] ?? '';
        $userNameQuery = $request['userNameQuery'] ?? '';
        $diagnoseQuery = $request['diagnoseQuery'] ?? '';

        $query = $this->medicalRecordRepository->getCollection($request);

        if ($id) {
            $query->where('id', $id);
        }
        if ($user_id) {
            $query->where('user_id', $user_id);
        }
        if ($doctor_id) {
            $query->where('doctor_id', $doctor_id);
        }

        if ($userNameQuery) {
            $query->select([
                'medical_records.*',
            ])
                ->leftJoin('users', 'medical_records.user_id', 'users.id')
                ->where('users.name', 'like', '%' . $userNameQuery . '%');;
        }

        if ($diagnoseQuery) {
            $query->where('diagnose', 'like', '%' . $diagnoseQuery . '%');;
        }

        $items = $query->orderByDesc('created_at')->paginate(5);

        $items->map(function ($item) {
            $item->user_name = $this->userRepository->detail($item->user_id)->name;
            $item->doctor_name = $this->userRepository->detail($item->doctor_id)->name;
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
            $item = $this->medicalRecordRepository->create($request->all());
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
            $post = $this->medicalRecordRepository->update($request->all(), $id);
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
            $this->medicalRecordRepository->delete($id);
        } catch (\Exception $e) {
            return $this->sendError('Vui lòng thử lại', $e->getMessage(), 'Có lỗi xảy ra');
        }

        return $this->sendSuccess('');
    }
}
