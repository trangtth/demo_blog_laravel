@extends('layouts.app')

@section('content')

@if (count($blogs) > 0)
<div class="row">
    @foreach ($blogs as $blog)
    <div class="col-md-6 col-md-offset-3">
        <div><h3>{{ $blog->title }}</h3></div>
        <h5>{{ $blog->content }}</h5>
        @if ($blog->image)
            <div><img src="{{ url('image/' . $blog->image) }}" width="70%"/></div>
        @endif

        @if ($blog->user)
        <h5 class="text-danger"><strong>Author:</strong> {{ $blog->user->name }} </h5>
        @endif
    </div>
    @endforeach
</div>
@endif
@endsection