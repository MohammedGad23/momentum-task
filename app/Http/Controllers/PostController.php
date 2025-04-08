<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

use App\Http\Requests\PostRequest\PostRequest;

class PostController extends Controller
{

    public function __construct(
        private PostService $postService
    ){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->postService->allPost();
    }



    /**
     * Store a newly created resource in storage.
     */
    public function createPost(PostRequest $request)
    {
        return $this->postService->createPost($request->user(),$request->array());
    }

    /**
     * Display the specified resource.
     */
    public function showPost(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePost(PostRequest $request, $post)
    {
        return $this->postService->updatePost($post ,$request->array());

    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletePost($post)
    {
        return $this->postService->deletePost($post);
    }
}
