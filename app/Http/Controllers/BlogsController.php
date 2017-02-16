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
        $allBlogs = Blogs::orderBy('created_at', 'asc')->get();
        $data = $request->all();

        if ($data['page_number'] < (count($allBlogs)/2)) {
            $results = Blogs::orderBy('created_at', 'desc')->skip($data['page_number'] * 2)->take(2)->get();

            foreach ($results as $r) {
                $r['image'] = url('/image/' . $r->image);
                $r['author'] = $r->user ? $r->user->name : '';
            }

            $isFinish = count($allBlogs) == ($data['page_number'] * 2 + count($results));
            if ($isFinish) {
                return response()->json(['response' => $results, 'status' => 400], 200);
            } else {
                return response()->json(['response' => $results, 'status' => 200], 200);
            }
        }
    }
}
