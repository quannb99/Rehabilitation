<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentRepository;

    public function __construct(
        CommentRepository $commentRepository
    ) {
        $this->commentRepository = $commentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request['id'] ?? '';

        $params['conditions'] = [
            'post_id' => $request->post_id,
        ];

        $query = $this->commentRepository->getCollection($params);
        $query->select([
            'comments.*',
            'users.name as user_name',
            'users.role as user_role',
        ])
        ->leftJoin('users', 'comments.user_id', 'users.id');

        if ($id) {
            $query->where('comments.id', $id);
        }

        $items = $query->orderByDesc('created_at')->paginate(5);

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
            $request->validate([
                'content' => 'required',
            ]);
            $comment = $this->commentRepository->create($request->all());
        } catch (\Exception $e) {
            return $this->sendError('Bạn chưa viết bình luận', 'Kiểm tra lại');
        }

        return $this->sendSuccess($comment->id);
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
        try {
            $request->validate([
                'content' => 'required',
            ]);
            $comment = $this->commentRepository->update($request->all(), $id);
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
            $comment = $this->commentRepository->delete($id);
        } catch (\Exception $e) {
            return $this->sendError('Vui lòng thử lại', 'Có lỗi xảy ra');
        }

        return $this->sendSuccess('');
    }
}
