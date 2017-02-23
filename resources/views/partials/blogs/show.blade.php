@extends('layouts.app')

@section('content')

<div class="panel-body col-md-6 col-md-offset-3">
    <article>
        <h2>{{ $blogs->title }}</h2>
        <h4>{{ $blogs->content }}</h4>
        @if ($blogs->image)
        <p><img src="{{ url('image/' . $blogs->image) }}" width="100%"/></p>
        <p class="text-danger"><strong>Author:</strong> {{ count($blogs->user()->get()) ? $blogs->user()->get()[0]['name'] : '' }}</p>
        @endif
    </article>

    <h3>Comments</h3>
    @if (count($blogs->comments))
        <ul class="list-group">
        @foreach($blogs->comments as $comment)
            <li class="list-group-item"><strong>{{ $comment->user->name }}</strong>: {{ $comment->body }} <span class="pull-right">{{ $comment->created_at }}</span></li>
        @endforeach
        </ul>
    @endif

    <!-- New Blog Form -->

    {!! Form::open(array('url' => url('blogs/'. $blogs->id. '/comment'), 'id' => 'comment-form', 'name' => 'comment-form', 'class' => 'form-horizontal', 'onsubmit' => 'false')) !!}

    @include ('partials.comments.form', ['submitButtonText' => 'Add Comment'])

    {!! Form::close() !!}

    <p>{!! link_to_route('blogs.index', 'Back to list blogs') !!}</p>

</div>

@endsection