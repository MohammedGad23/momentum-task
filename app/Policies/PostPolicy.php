<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    public function update(User $user, Post $post): bool
    {
        // for sure user can update their own post
        return $user->id === $post->user_id;
    }

    public function delete(User $user, Post $post): bool
    {
        // for sure user can delete their own post
        return $user->id === $post->user_id;
    }
}
