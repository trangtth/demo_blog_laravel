@extends('layouts.app')

@section('content')

<div class="panel-body">
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <a class="btn btn-default" href="{{ url('admin/blogs/create') }}">
                <i class="fa fa-plus"></i> Add Blog
            </a>
            <a class="btn btn-default" href="{{ url('admin/blogs/deleteBlogChecked') }}" data-csrf="{{ Session::token() }}" id="btn-delete-blogs-checked" onclick="return false;">
                <i class="fa fa-trash"></i> Delete Blogs
            </a>
        </div>
    </div>
</div>

<div class="row">
	<div class="panel-body">
	{!! $dataTable->table(['class' => 'table table-striped dataTable', 'id' => 'datatableBlogs'], true) !!}
	</div>
</div>
@endsection