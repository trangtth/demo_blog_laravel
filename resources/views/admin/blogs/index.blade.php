@extends('layouts.app')

@section('content')

<div class="panel-body">
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <a class="btn btn-default" href="{{ url('admin/blogs/create') }}">
                <i class="fa fa-plus"></i> Add Blog
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