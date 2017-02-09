@extends('layouts.app')

@section('content')

<div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')

    <!-- New Blog Form -->

    {!! Form::open(array('url' => route('blogs.store'), 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')) !!}

    @include ('blogs.form', ['submitButtonText' => 'Add Blog'])

    {!! Form::close() !!}
</div>

@endsection