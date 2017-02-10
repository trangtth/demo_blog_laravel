<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Blogs;
use Validator;
use Auth;
use App\Http\Requests\BlogRequest;

class BlogsController extends Controller
{
    /**
     * Upload picture for blog
     */
    public function uploadPictureOfBlog(BlogRequest $request)
    {
        $picture = '';
        if ($request->hasFile('image')) {
            $files = array(
                $request->file('image')
            );

            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = date('His') . $filename . $extension;
                $destinationPath = base_path() . '\public\image';
                $file->move($destinationPath, $picture);
            }
        }

        return $picture;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blogs::orderBy('created_at', 'asc')->get();

        return view('blogs/index', [
            'blogs' => $blogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            return view('blogs/create');
        } else {
            return redirect('/login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $picture = $this->uploadPictureOfBlog($request);

        $data = $request->all();
        $data['author_id'] = Auth::user()->id ? Auth::user()->id : 0;

        if ($picture) {
            $data['image'] = $picture;
        }

        Blogs::create($data);

        return redirect('/blogs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Blogs $blogs)
    {
        return view('blogs.show', compact('blogs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blogs $blogs)
    {
        return view('blogs.edit', compact('blogs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, Blogs $blogs)
    {
        $picture = $this->uploadPictureOfBlog($request);

        $data = $request->all();

        if ($picture) {
            $data['image'] = $picture;
        }

        $blogs->update($data);

        return redirect('blogs');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blogs $blogs)
    {
        $result = $blogs->delete();

        //return redirect('/blogs');

        if ($result) {
            return response()->json(['responseText' => 'Blog was deleted.', 'status' => 200], 200);
        }
    }
}
