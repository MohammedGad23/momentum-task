<?php


namespace App\Services;

use App\Models\Post;
use App\Models\User;


use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;


use App\Http\Resources\PostResource;
class PostService
{
    public function allPost(){
        try{

            $posts = Post::all();

            return PostResource::collection($posts);

        }catch (\Exception $e){

            return response()->json([
                'error'=>'Something went wrong, Please try again.'
            ],500);
        }
    }

    public function createPost(User $user,array $data){
        try{

            $user->userPosts()->create($data);

            return response()->Json([
                'success'=>'Post Created successfully',
            ],200);

        }catch (\Exception $e){

            return response()->json([
                'error'=>'Something went wrong, Please try again.'
            ],500);
        }
    }


    public function updatePost($post, array $data){
        try{
            $post = Post::find($post);

            // to sure that this post exist or not
            if(!$post){
                return response()->json([
                    'error'=>'Post not found'
                ],404);
            }

            // I want use policy for check user is owner this post or not.

            Gate::authorize('update', $post);

            $post->update($data);

            return response()->Json([
                'success'=>'Post Updated successfully',
            ],200);

        }catch (AuthorizationException $e) {

            return response()->json([
                'error' => 'You are not authorized to update this post',
            ], 403);

        }catch (\Exception $e){

            return response()->json([
                'error'=>'Something went wrong, Please try again.',
            ],500);
        }
    }


    public function deletePost($post){
        try{

            // to sure that this post exist or not

            $post = Post::find($post);
            if(!$post){
                return response()->json([
                    'error'=>'Post not found'
                ],404);
            }

            // I want use policy for check user is owner this post or not.

            Gate::authorize('delete', $post);

            $post->delete();

            return response()->Json([
                'success'=>'Post Deleted successfully',
            ],200);

        }catch (AuthorizationException $e) {
            // Specific handling for authorization failures
            return response()->json([
                'error' => 'You are not authorized to delete this post',
            ], 403);

        }catch (\Exception $e){
            return response()->json([
                'error'=>'Something went wrong, Please try again.'
            ],500);
        }
    }

}

