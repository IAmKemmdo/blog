<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Post $post): RedirectResponse
    {
        $post->comments()->create($request->validated());

        return redirect()
            ->to(route('posts.show', $post->slug).'#comments')
            ->with('status', 'Komentarz został dodany.');
    }
}
