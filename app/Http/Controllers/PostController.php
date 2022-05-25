<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PostRepository;

class PostController extends Controller
{
    /**
     * @var PostRepository
     */
    protected $postRepository;

    public function __construct(
        PostRepository $postRepository
    ) {
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request['id'] ?? '';

        $query = $this->postRepository->getCollection($request)
        ->select([
            'posts.*',
            'users.name as user_name',
            'users.role as user_role',
        ])
        ->leftJoin('users', 'posts.user_id', 'users.id');

        if ($id) {
            $query->where('posts.id', $id);
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
                'title' => 'required',
                'content' => 'required',
            ]);
            $post = $this->postRepository->create($request->all());
        } catch (\Exception $e) {
            return $this->sendError('Vui lòng nhập đủ các trường', 'Kiểm tra lại');
        }

        return $this->sendSuccess($post->id);
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
            $post = $this->postRepository->update($request->all(), $id);
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
            $post = $this->postRepository->delete($id);
        } catch (\Exception $e) {
            return $this->sendError('Vui lòng thử lại', 'Có lỗi xảy ra');
        }

        return $this->sendSuccess('');
    }
}
