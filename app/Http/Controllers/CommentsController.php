<?php

namespace App\Http\Controllers;

use App\Blogs;
use Illuminate\Http\Request;

use Auth;
use App\Comments;

use App\Http\Requests;
use App\Http\Requests\CommentsRequest;

class CommentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentsRequest $request, Blogs $blogs)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id ? Auth::user()->id : 0;
        $data['blog_id'] = $blogs->id;

        Comments::create($data);

        return redirect('blogs/' . $blogs->id);
    }
}
