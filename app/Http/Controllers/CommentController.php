<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Models\comment;
use  App\Models\Replay;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function add_comment(Request $request)
    {
        if(Auth::user()){
            $comment= new comment;
            $comment->comment=$request->commentContent;
            $comment->user_id=Auth::user()->id;
            $comment->name=Auth::user()->name;
            $comment->save();
            return redirect()->back();

        }
        return redirect('login');
    }

    public function add_replay(Request $request,$id)
    {
        if(Auth::user()){
            $replay= new Replay;
            $replay->replay=$request->replyContent;
            $replay->user_id=Auth::user()->id;
            $replay->name=Auth::user()->name;
            $replay->comment_id=$id;
            $replay->save();
            return redirect()->back();

        }
        return redirect('login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
