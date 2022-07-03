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
        $titleQuery = $request['titleQuery'] ?? '';
        $type = $request['type'] ?? '';
        $getNewPosts = $request['getNewPosts'] ?? '';
        $getFeaturePosts = $request['getFeaturePosts'] ?? '';

        $query = $this->postRepository->getCollection($request)
            ->select([
                'posts.*',
                'users.name as user_name',
                'users.role as user_role',
                'users.avatar as user_avatar',
            ])
            ->leftJoin('users', 'posts.user_id', 'users.id');

        if ($id) {
            $query->where('posts.id', $id);
        }

        if ($titleQuery) {
            $query->where('posts.title', 'like', '%' . $titleQuery . '%');
        }

        if ($type) {
            $query->where('posts.type', 'like', '%' . $type . '%');
        }

        if ($getNewPosts) {
            $items = $query->orderByDesc('created_at')->take($getNewPosts)->get();
            return $this->sendSuccess($items);
        }

        if ($getFeaturePosts) {
            $items = $query->whereIn('posts.title',
            ['Chế độ ăn uống cho người nhiễm Covid-19', 'Làm việc từ xa trong mùa Covid-19: Góc nhìn từ phía y học', 'Kiến thức cơ bản về chăm sóc người bệnh hậu Covid-19'])
            ->orderBy('created_at')->take(3)->get();
            return $this->sendSuccess($items);
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
            $item = $this->postRepository->create($request->all());
        } catch (\Exception $e) {
            return $this->sendError('Vui lòng nhập đủ các trường', $e->getMessage(), 'Kiểm tra lại');
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
            $request->validate([
                'title' => 'required',
                'content' => 'required',
            ]);
            $post = $this->postRepository->update($request->all(), $id);
        } catch (\Exception $e) {
            return $this->sendError('Vui lòng nhập đủ các trường', $e->getMessage(), 'Kiểm tra lại');
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
            $this->postRepository->delete($id);
        } catch (\Exception $e) {
            return $this->sendError('Vui lòng thử lại', $e->getMessage(), 'Có lỗi xảy ra');
        }

        return $this->sendSuccess('');
    }
}
