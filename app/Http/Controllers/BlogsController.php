<?php

namespace App\Http\Controllers;

use App\Blogs;
use App\Bloglikes;
use Auth;

use Validator;

use Illuminate\Http\Request;
use App\Http\Requests;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blogs::orderBy('created_at', 'desc')->paginate(3);

        foreach ($blogs as $blog) {
            $blogId = $blog->id;

            if (Auth::user()) {
                $userId = Auth::user()->id;
            }

            if (isset($blogId) && isset($userId)) {
                $blog->isLiked = Bloglikes::where('user_id', $userId)->where('blog_id', $blogId)->get()->count() > 0 ? true : false;
                $blog->numLiked = Bloglikes::where('user_id', $userId)->where('blog_id', $blogId)->get()->count();
            }
        }

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

        if ($data['page_number'] < (count($allBlogs)/3)) {
            $results = Blogs::orderBy('created_at', 'desc')->skip($data['page_number'] * 3)->take(3)->get();

            $html = '';
            foreach ($results as $blog) {
                $blogId = $blog->id;
                $userId = Auth::user()->id;
                $blog->isLiked = Bloglikes::where('user_id', $userId)->where('blog_id', $blogId)->get()->count() > 0 ? true : false;
                $html .= view('frontend.blogs.item', compact('blog', 'isLogin'))->render();
            }

            $isFinish = count($allBlogs) == ($data['page_number'] * 3 + count($results));
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

        $bloglikes = Bloglikes::withTrashed()->where('user_id', $userId)->where('blog_id', $blogId)->get();

        if (count($bloglikes)) {
            $results = $bloglikes[0];
            if ($results->deleted_at) {
                $results->deleted_at = null;
                $results->update($data);
            }
        } else {
            Bloglikes::create($data);
        }

        return response()->json(['status' => 200], 200);
    }

    public function unlike(Request $request)
    {
        $data = $request->all();

        $blogId = $data['blog_id'];
        $userId = Auth::user()->id;

        $data['blog_id'] = $blogId;
        $data['user_id'] = $userId;

        $bloglikes = Bloglikes::withTrashed()->where('user_id', $userId)->where('blog_id', $blogId)->get();

        if (count($bloglikes)) {
            $results = $bloglikes[0];
            if (!$results->deleted_at) {
                $results->delete();
            }
        }

        return response()->json(['status' => 200], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Blogs $blogs)
    {
        return view('partials.blogs.show', compact('blogs'));
    }
}
