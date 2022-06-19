<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MessageRepository;
use App\Events\MessageSent;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    protected $messageRepository;
    protected $userRepository;

    public function __construct(
        MessageRepository $messageRepository,
        UserRepository $userRepository
    ) {
        $this->messageRepository = $messageRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $res = $this->messageRepository->getCollection($request)
            ->where([
                ['user_a_id', '=', auth()->user()->id],
                ['user_b_id', $request->user_b_id]
            ])
            ->orWhere([
                ['user_b_id', '=', auth()->user()->id],
                ['user_a_id', $request->user_b_id]
            ])
            ->orderByDesc('created_at')
            ->paginate(20);

        // $items = $query->orderByDesc('created_at')->paginate(5);

        return $this->sendSuccess($res);
    }

    public function getmessagesHistory(Request $request)
    {
        $res = $this->messageRepository->getCollection($request)
            ->where([
                ['user_a_id', '=', auth()->user()->id],
            ])
            ->orWhere([
                ['user_b_id', '=', auth()->user()->id],
            ])
            ->orderByDesc('created_at')
            ->get();

        $res = $res->map(function ($item) {
            if ($item->user_a_id == auth()->user()->id) {
                return $item->user_b_id;
            } else {
                return $item->user_a_id;
            }
        })->toArray();

        $listUsersId = array_unique($res);
        $listUsers = [];
        foreach ($listUsersId as $key => $value) {
            $temp = $this->userRepository->getCollection('')
            ->select('name', 'role', 'avatar', 'id')
            ->where('id', $value)->get()->first();
            array_push($listUsers, $temp);
        }

        $res = [];
        foreach ($listUsersId as $key => $value) {
            $temp = $this->messageRepository->getCollection($request)
            ->where([
                ['user_a_id', '=', auth()->user()->id],
                ['user_b_id', $value]
            ])
            ->orWhere([
                ['user_b_id', '=', auth()->user()->id],
                ['user_a_id', $value]
            ])
            ->orderByDesc('created_at')
            ->first();
            array_push($res, $temp);
        }

        for ($i = 0; $i < count($res); $i++) {
            $res[$i]['user_name'] = $listUsers[$i]['name'];
            $res[$i]['role'] = $listUsers[$i]['role'];
            $res[$i]['avatar'] = $listUsers[$i]['avatar'];
            $res[$i]['user_id'] = $listUsers[$i]['id'];
        }

        return $this->sendSuccess($res);
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
            $message = $this->messageRepository->create($request->all());
            // $message = $query->get();
            broadcast(new MessageSent($user, $message))->toOthers();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 'Có lỗi xảy ra');
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
            $request->validate([
                'title' => 'required',
                'content' => 'required',
            ]);
            $post = $this->messageRepository->update($request->all(), $id);
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
            $this->messageRepository->delete($id);
        } catch (\Exception $e) {
            return $this->sendError('Vui lòng thử lại', 'Có lỗi xảy ra');
        }

        return $this->sendSuccess('');
    }
}
