<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RateRepository;
use App\Repositories\TreatmentRepository;
use App\Repositories\UserRepository;

class RateController extends Controller
{
    protected $rateRepository;
    protected $treatmentRepository;
    protected $userRepository;

    public function __construct(
        RateRepository $rateRepository,
        TreatmentRepository $treatmentRepository,
        UserRepository $userRepository
    ) {
        $this->rateRepository = $rateRepository;
        $this->treatmentRepository = $treatmentRepository;
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
        $titleQuery = $request['titleQuery'] ?? '';

        $query = $this->rateRepository->getCollection($request)
            ->select([
                'rates.*',
                'treatments.title as title',
                'treatments.objective as objective',
                'treatments.difficulty as difficulty',
            ])
            ->leftJoin('treatments', 'rates.treatment_id', 'treatments.id');

        if ($id) {
            $query->where('rates.id', $id);
        }

        if ($titleQuery) {
            $query->where('treatments.title', 'like', '%' . $titleQuery . '%');
        }

        $items = $query->orderByDesc('created_at')->paginate(5);

        $items->map(function ($item) {
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
            $item = $this->rateRepository->create($request->all());
        } catch (\Exception $e) {
            return $this->sendError('Có lỗi xảy ra, vui lòng thử lại', 'Kiểm tra lại');
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
            $this->rateRepository->update($request->all(), $id);
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
            $this->rateRepository->delete($id);
        } catch (\Exception $e) {
            return $this->sendError('Vui lòng thử lại', 'Có lỗi xảy ra');
        }

        return $this->sendSuccess('');
    }
}
