<?php

namespace App\Http\Controllers;

use App\Events\IncomingCall;
use App\Events\CallResponse;
use App\Repositories\MessageRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $userRepository;
    protected $messageRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, MessageRepository $messageRepository)
    {
        $this->userRepository = $userRepository;
        $this->messageRepository = $messageRepository;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('common');
    }

    public function forum()
    {
        return view('common');
    }

    public function newPost()
    {
        return view('common');
    }

    public function checkAuth()
    {
        return Auth::check();
    }

    public function call(Request $request) {
        $user = Auth::user();
        $otherUserId = $request->id;
        $form = [
            'user_a_id' => $user->id,
            'user_b_id' => $otherUserId,
            'content' => '📲 ' . $user->name . ' đã gọi cho bạn',
        ];
        $this->messageRepository->create($form);
        $otherUser = $this->userRepository->detail($otherUserId);
        broadcast(new IncomingCall($user, $otherUser))->toOthers();
    }

    public function callResponse(Request $request) {
        $user = Auth::user();
        $res = $request->response;
        if ($res == 'abort') {
            $form = [
                'user_b_id' => $user->id,
                'user_a_id' => $request->userId,
                'content' => '📞 Bạn đã bỏ lỡ cuộc gọi từ ' . $user->name,
            ];
            $this->messageRepository->create($form);
        }
        broadcast(new CallResponse($user, $res))->toOthers();
    }
}
