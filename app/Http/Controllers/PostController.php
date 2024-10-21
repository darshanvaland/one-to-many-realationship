<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('comments')->get();
        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Create a new post
        $post = Post::create($validated);

        // Optional: Add a comment at the time of post creation
        if ($request->has('comment')) {
            $post->comments()->create([
                'comment' => $request->comment
            ]);
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function addComment(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $post->comments()->create([
            'comment' => $request->comment,
        ]);

        return redirect()->route('posts.index')->with('success', 'Comment added successfully.');
    }
}
