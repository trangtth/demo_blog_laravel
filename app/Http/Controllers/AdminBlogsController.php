<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Blogs;
use Validator;
use App\Http\Requests\BlogRequest;

use App\DataTables\BlogsDataTable;

class AdminBlogsController extends Controller
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
                $picture = date('His') . trim($filename);
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
    public function index(BlogsDataTable $dataTable)
    {
//        $blogs = Blogs::orderBy('created_at', 'asc')->get();
//
//        return view('admin/blogs/index', [
//            'blogs' => $blogs,
//            'isAdmin' => User::$ROLE[Auth::user()->role] == 'admin'
//        ]);

        return $dataTable->render('admin.blogs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/blogs/create');
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

        return redirect('admin/blogs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Blogs $blogs)
    {
        return view('admin.blogs.show', compact('blogs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blogs $blogs)
    {
        return view('admin.blogs.edit', compact('blogs'));
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

        return redirect('admin/blogs');

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

        if ($result) {
            return response()->json(['responseText' => 'Blog was deleted.', 'status' => 200], 200);
        }
    }
}
