<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    // Ensure that only authenticated users can perform these actions
    public function __construct()
    {
        $this->middleware('auth:api'); // Use JWT or session auth for API
    }

    // Create a new post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(), // Associate the post with the authenticated user
        ]);

        return response()->json($post, 201);
    }

    // Get all posts
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    // Get a single post by ID
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return response()->json($post);
    }

    // Update a post
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Ensure that the user is the owner of the post
        if ($post->user_id != Auth::id()) {
            return response()->json(['error' => 'You do not have permission to update this post'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json($post);
    }

    // Delete a post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Ensure that the user is the owner of the post
        if ($post->user_id != Auth::id()) {
            return response()->json(['error' => 'You do not have permission to delete this post'], 403);
        }

        $post->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
