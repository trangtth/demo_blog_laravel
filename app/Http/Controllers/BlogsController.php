<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Blogs;
use Validator;
use Auth;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blogs::orderBy('created_at', 'desc')->get();

        return view('welcome', [
            'blogs' => $blogs
        ]);
    }
}
