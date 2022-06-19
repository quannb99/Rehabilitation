<?php

namespace App\Http\Controllers;

use App\Events\IncomingCall;
use App\Events\CallResponse;
use App\Notifications\ReportPost;
use App\Repositories\AppointmentRepository;
use App\Repositories\MedicalRecordRepository;
use App\Repositories\MessageRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    protected $userRepository;
    protected $messageRepository;
    protected $postRepository;
    protected $appointmentRepository;
    protected $medicalRecordRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, MessageRepository $messageRepository, PostRepository $postRepository, AppointmentRepository $appointmentRepository, MedicalRecordRepository $medicalRecordRepository)
    {
        $this->userRepository = $userRepository;
        $this->messageRepository = $messageRepository;
        $this->postRepository = $postRepository;
        $this->appointmentRepository = $appointmentRepository;
        $this->medicalRecordRepository = $medicalRecordRepository;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role != 3) {
            return view('common');
        } else {
            return view('admin');
        }
    }

    public function getAdmins()
    {
        $admin = $this->userRepository->getCollection('')->where('role', 3)->get();

        return $admin;
    }

    public function checkAuth()
    {
        return Auth::check();
    }

    public function call(Request $request)
    {
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

    public function callResponse(Request $request)
    {
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

    public function reportPost(Request $request)
    {
        $admins = $this->getAdmins();
        $post = $this->postRepository->detail($request->id);
        $user = $this->userRepository->detail($request->user_id);
        Notification::send($admins, new ReportPost($post, $user));
    }

    public function getNotifications(Request $request)
    {
        $notifications = Auth::user()->notifications;

        return $this->sendSuccess($notifications);
    }

    public function dashboard(Request $request)
    {
        $userCount = $this->userRepository->getCollection('')->where('role', 1)->count();
        $doctorCount = $this->userRepository->getCollection('')->where('role', 2)->count();
        $postCount = $this->postRepository->getCollection('')->count();
        $appointmentCount = $this->appointmentRepository->getCollection('')->count();
        $recordCount = $this->medicalRecordRepository->getCollection('')->count();
        // dd(Auth::user()->notifications->where('type', 'like', '%Report%'));
        $reportCount = Auth::user()->notifications->count();

        $res = [
            'user' => $userCount,
            'doctor' => $doctorCount,
            'post' => $postCount,
            'appointment' => $appointmentCount,
            'record' => $recordCount,
            'report' => $reportCount,
        ];

        return $this->sendSuccess($res);
    }
}
