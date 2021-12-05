<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    public function store(Post $post)
    {
        //validation for required body input 
        request()->validate([
            'body'=>'required'
        ]);

        // add comments to to the give post
        $post->comments()->create([
            'post_id'=>request()->post->id,
            'user_id'=>request()->user()->id,
            'body'   =>request('body')
        ]);

        return back();

    }
    
}
