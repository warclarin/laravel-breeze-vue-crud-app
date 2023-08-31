<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::count();
        $comments = Comment::count();
        $users = User::count();

        return Inertia::render('Dashboard', [
            'posts' => $posts,
            'comments' => $comments,
            'users' => $users
        ]);
    }
}
