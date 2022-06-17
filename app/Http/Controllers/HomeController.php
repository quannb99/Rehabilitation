<?php

namespace App\Http\Controllers;

use App\Events\IncomingCall;
use App\Events\CallResponse;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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
        $otherUser = $this->userRepository->detail($otherUserId);
        broadcast(new IncomingCall($user, $otherUser))->toOthers();
    }

    public function callResponse(Request $request) {
        $user = Auth::user();
        $res = $request->response;
        broadcast(new CallResponse($user, $res))->toOthers();
    }
}
