@extends('layouts.app')

@section('content')

    <div class="panel-body">
        @if ($blogs)
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Blog Form -->

        {!! Form::model($blogs, ['method' => 'PATCH', 'route' => ['blogs.update', $blogs->id], 'id' => 'blog-form', 'name' => 'blog-form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}

        @include ('blogs.form', ['submitButtonText' => 'Update Blog'])

        {!! Form::close() !!}
        @else
            Blog not found
        @endif
    </div>

@endsection