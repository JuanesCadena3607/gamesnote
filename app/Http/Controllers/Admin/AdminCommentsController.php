<?php

namespace App\Http\Controllers\Admin;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class AdminCommentsController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->check() && auth()->user()->role == 1) {
            $commentsQuery = Comment::with('videoGame');

            if ($request->has('search')) {
                $search = $request->input('search');
                $commentsQuery->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                });
            }

            $comments = $commentsQuery->paginate(10);

            return view('admin.comments.index', ['comments' => $comments]);
        }

        return redirect()->route('home')->with('error', 'No tiene permisos para acceder a esta página');
    }

}
