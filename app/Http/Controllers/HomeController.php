<?php

namespace App\Http\Controllers;

use App\Events\IncomingCall;
use App\Events\CallResponse;
use App\Notifications\ReportComment;
use App\Notifications\ReportPost;
use App\Repositories\AppointmentRepository;
use App\Repositories\CommentRepository;
use App\Repositories\MedicalRecordRepository;
use App\Repositories\MessageRepository;
use App\Repositories\PostRepository;
use App\Repositories\ReportRepository;
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
    protected $commentRepository;
    protected $reportRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, MessageRepository $messageRepository, PostRepository $postRepository, AppointmentRepository $appointmentRepository, MedicalRecordRepository $medicalRecordRepository, CommentRepository $commentRepository, ReportRepository $reportRepository)
    {
        $this->userRepository = $userRepository;
        $this->messageRepository = $messageRepository;
        $this->postRepository = $postRepository;
        $this->appointmentRepository = $appointmentRepository;
        $this->medicalRecordRepository = $medicalRecordRepository;
        $this->commentRepository = $commentRepository;
        $this->reportRepository = $reportRepository;
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
        $postUser = $this->userRepository->detail($post->user_id);
        Notification::send($admins, new ReportPost($post, $user, $postUser));
        // $form = [
        //     'user_id' => $request->user_id,
        //     'reportable_id' => $request->id,
        //     'reportable_type' => 'post',
        // ];
        // $this->reportRepository->create($form);
    }

    public function reportComment(Request $request)
    {
        $admins = $this->getAdmins();
        $comment = $this->commentRepository->detail($request->id);
        $user = $this->userRepository->detail($request->user_id);
        $commentUser = $this->userRepository->detail($comment->user_id);
        Notification::send($admins, new ReportComment($comment, $user, $commentUser));
        // $form = [
        //     'user_id' => $request->user_id,
        //     'reportable_id' => $request->id,
        //     'reportable_type' => 'comment',
        // ];
        // $this->reportRepository->create($form);
    }

    public function getNotifications(Request $request)
    {
        $id = $request['id'] ?? '';
        $type = $request['type'] ?? null;

        $query = Auth::user()->notifications();

        if ($id) {
            $query->where('id', $id);
        }

        if ($type != null) {
            $query->where('solved', $type);
        }

        $res = $query->orderByDesc('created_at')->paginate(10);
        return $this->sendSuccess($res);
    }

    // public function getReports(Request $request)
    // {
    //     $postReports = $this->reportRepository->getCollection('')->where('type', 'post')
    //         ->select([
    //             'reports.*',
    //             'users.name as user_name',
    //             'users.role as user_role',
    //             'users.avatar as user_avatar',
    //         ])
    //         ->leftJoin('users', 'posts.user_id', 'users.id');

    //     return $this->sendSuccess($notifications);
    // }

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

    public function markNotification(Request $request)
    {
        try {
            $notification = Auth::user()->notifications()->where('id', $request->id)->first();
            $notification->update([
                'solved' => $request->solved
            ]);
        } catch (\Exception $e) {
            return $this->sendError('Vui lòng thử lại', 'Có lỗi xảy ra');
        }

        return $this->sendSuccess('');
    }
}
