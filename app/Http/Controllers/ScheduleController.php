<?php

namespace App\Http\Controllers;

use App\Repositories\ScheduleRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    protected $scheduleRepository;

    public function __construct(
        ScheduleRepository $scheduleRepository
    ) {
        $this->scheduleRepository = $scheduleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $query = $this->scheduleRepository->getCollection($request);
        // $items = $query->where('user_id', auth()->user()->id)->get();

        // return $this->sendSuccess($items);
    }


    public function getSchedule(Request $request)
    {
        $query = $this->scheduleRepository->getCollection($request);
        $res = $query->where('user_id', auth()->user()->id)->get();

        $items = $res->map(function ($item) {
            $item['Id'] = $item['id'];
            $item['Subject'] = $item['title'];
            $item['StartTime'] = $item['start_at'];
            $item['EndTime'] = $item['end_at'];
            $item['Description'] = $item['content'] ?? null;
            $item['RecurrenceRule'] = $item['recurrence_rule'] ?? null;
            $item['RecurrenceException'] = $item['recurrence_exception'] ?? null;
            $item['RecurrenceID'] = $item['recurrence_id'] ?? null;
            unset($item['id'], $item['title'], $item['start_at'], $item['end_at'], $item['content'], $item['recurrence_rule']);
            return $item;
        });
        return response()->json($items);
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

    public function formatDateTime($dateTime)
    {
        return Carbon::parse($dateTime)->format('Y-m-d H:i:s');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->all();
        if ($params['added']) {
            $param = $params['added'][0];
            $data = [
                'user_id' => auth()->user()->id,
                'title' => $param['Subject'],
                'start_at' => $param['StartTime'],
                'end_at' => $param['EndTime'],
                'content' => $param['Description'] ?? null,
                'recurrence_rule' => $param['RecurrenceRule'] ?? null,
                'recurrence_exception' => $param['RecurrenceException'] ?? null,
                'recurrence_id' => $param['RecurrenceID'] ?? null,
            ];

            try {
                $this->scheduleRepository->create($data);
            } catch (\Exception $e) {
                return $this->sendError('Vui lòng thử lại', 'Có lỗi xảy ra');
            }
        }

        if ($params['changed']) {
            $param = $params['changed'][0];
            $id = $param['Id'];
            $data = [
                'user_id' => $param['user_id'],
                'title' => $param['Subject'],
                'start_at' => $param['StartTime'],
                'end_at' => $param['EndTime'],
                'content' => $param['Description'] ?? null,
                'recurrence_rule' => $param['RecurrenceRule'] ?? null,
                'recurrence_exception' => $param['RecurrenceException'] ?? null,
                'recurrence_id' => $param['RecurrenceID'] ?? null,
            ];
            try {
                $this->scheduleRepository->update($data, $id);
            } catch (\Exception $e) {
                return $this->sendError('Vui lòng thử lại', 'Có lỗi xảy ra');
            }
        }

        if ($params['deleted']) {
            // $param = $params['deleted'][0];
            foreach ($params['deleted'] as $param) {
                $id = $param['Id'];
                try {
                    $this->scheduleRepository->delete($id);
                } catch (\Exception $e) {
                    return $this->sendError('Vui lòng thử lại', 'Có lỗi xảy ra');
                }
            }
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
            $this->scheduleRepository->delete($id);
        } catch (\Exception $e) {
            return $this->sendError('Vui lòng thử lại', 'Có lỗi xảy ra');
        }

        return $this->sendSuccess('');
    }
}
