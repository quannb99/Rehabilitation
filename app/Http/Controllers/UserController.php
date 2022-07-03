<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
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
        $role = $request['role'] ?? '';
        $specialist_id = $request['specialist_id'] ?? '';
        $user_name = $request['user_name'] ?? '';
        $nonAdmin = $request['nonAdmin'] ?? '';

        $query = $this->userRepository->getCollection($request)
            ->select([
                'users.*',
                'specialists.name as specialist_name',
            ])
            ->leftJoin('specialists', 'specialists.id', 'users.specialist_id');

        if ($id) {
            $query->where('users.id', $id);
        }

        if ($nonAdmin) {
            $query->where('role', '<>', 3);
        }

        if ($role) {
            $query->where('role', $role);
        }

        if ($specialist_id) {
            $query->where('specialist_id', $specialist_id);
        }

        if ($user_name) {
            $query->where('users.name', 'like', '%' . $user_name . '%');
        }

        $items = $query->orderByDesc('created_at')->paginate(5);

        $items->map(function ($item) {
            $item->schedules = $this->userRepository->detail($item->id)->schedules()
                ->where('recurrence_rule', 'like', 'FREQ=WEEKLY%')
                ->where('title', 'like', '%bệnh%')
                ->whereNull('recurrence_id')
                ->orderBy('start_at')
                ->get();
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
            $request['password'] = Hash::make($request->password);
            if ($request->image) {
                $file = $request->file('image');
                $fileName = uniqid() . $file->getClientOriginalName();;
                $destinationPath = public_path() . '/uploads';
                $file->move($destinationPath, $fileName);
                $avatar = '../../uploads/' . $fileName;
                $request['avatar'] = $avatar;
            }
            $this->userRepository->create($request->only(['name', 'role', 'avatar', 'email', 'password', 'specialist_id']));
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
            if ($request->deactive) {
                $user = $this->userRepository->detail($id);
                $user->deactive = 1;
                $user->save();
                return $this->sendSuccess('');
            }
            if ($request->active) {
                $user = $this->userRepository->detail($id);
                $user->deactive = 0;
                $user->save();
                return $this->sendSuccess('');
            }

            if ($request->image) {
                $file = $request->file('image');
                $fileName = uniqid() . $file->getClientOriginalName();;
                $destinationPath = public_path() . '/uploads';
                $file->move($destinationPath, $fileName);
                $avatar = '../../uploads/' . $fileName;
                $request['avatar'] = $avatar;
                $currentAvatar = $this->userRepository->detail($request->id)->avatar;
                if ($currentAvatar != '../../images/user-default-ava.jpg') {
                    $currentFileName = substr($currentAvatar, 5);
                    File::delete(public_path() . $currentFileName);
                }
            }

            if ($request->password) {
                $request['password'] = Hash::make($request->password);
            }

            $user = $this->userRepository->update($request->only(['name', 'gender', 'phone', 'avatar', 'birthyear', 'password']), $id);
        } catch (\Exception $e) {
            return $this->sendError('Vui lòng thử lại', 'Kiểm tra lại');
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
            $this->userRepository->delete($id);
        } catch (\Exception $e) {
            return $this->sendError('Vui lòng thử lại', $e->getMessage(), 'Có lỗi xảy ra');
        }

        return $this->sendSuccess('');
    }
}
