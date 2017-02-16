<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Blogs;
use App\Bloglikes;
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
            'blogs' => $blogs,
            'isLogin' => Auth::check()
        ]);
    }

    public function loadmore(Request $request)
    {
        $isLogin = Auth::check();

        $allBlogs = Blogs::orderBy('created_at', 'asc')->get();
        $data = $request->all();

        if ($data['page_number'] < (count($allBlogs)/2)) {
            $results = Blogs::orderBy('created_at', 'desc')->skip($data['page_number'] * 2)->take(2)->get();

            $html = '';
            foreach ($results as $blog) {
//                $r['image'] = url('/image/' . $r->image);
//                $r['author'] = $r->user ? $r->user->name : '';

                $html .= view('frontend.blogs.item', compact('blog', 'isLogin'))->render();
            }

            $isFinish = count($allBlogs) == ($data['page_number'] * 2 + count($results));
            if ($isFinish) {
                return response()->json(['html' => $html, 'status' => 400], 200);
            } else {
                return response()->json(['html' => $html, 'status' => 200], 200);
            }
        }
    }

    public function like(Request $request)
    {
        $data = $request->all();

        $blogId = $data['blog_id'];
        $userId = Auth::user()->id;

        $data['blog_id'] = $blogId;
        $data['user_id'] = $userId;

        $results = Bloglikes::where();

        Bloglikes::create($data);
    }
}
