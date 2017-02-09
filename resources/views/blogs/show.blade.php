@extends('layouts.app')

@section('content')

<div class="panel-body">
    <article>
        <h2>{{ $blogs->title }}</h2>
        <h4>{{ $blogs->content }}</h4>
        @if ($blogs->image)
        <p><img src="{{ url('image/' . $blogs->image) }}"/></p>
        <p><strong>Author:</strong> {{ count($blogs->user()->get()) ? $blogs->user()->get()[0]['name'] : '' }}</p>
        @endif
    </article>
    <p>{!! link_to_route('blogs.index', 'Back to list blogs') !!}</p>

</div>

@endsection