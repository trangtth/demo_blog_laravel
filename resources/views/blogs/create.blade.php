@extends('layouts.app')

@section('content')

<div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')

    <!-- New Blog Form -->

    {!! Form::open(array('url' => route('blogs.store'), 'id' => 'blog-form', 'name' => 'blog-form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'onsubmit' => 'false')) !!}

    @include ('blogs.form', ['submitButtonText' => 'Add Blog'])

    {!! Form::close() !!}
</div>

@endsection