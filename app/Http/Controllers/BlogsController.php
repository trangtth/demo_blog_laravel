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
        $blogs = Blogs::orderBy('created_at', 'desc')->paginate(2);

        return view('welcome', [
            'blogs' => $blogs
        ]);
    }

    public function loadmore(Request $request, Blogs $blogs)
    {
        $data = $request->all();
        $results = Blogs::orderBy('created_at', 'desc')->skip($data['page_number']*2)->take(2)->get();

        return response()->json(['response' => $results, 'status' => 200], 200);
    }
}
