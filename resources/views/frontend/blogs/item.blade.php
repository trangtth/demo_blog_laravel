<div class="col-md-6 col-md-offset-3">
    <div><h3>{{ $blog->title }}</h3></div>
    <h5>{{ $blog->content }}</h5>
    @if ($blog->image)
        <div><img src="{{ url('image/' . $blog->image) }}" width="70%"/></div>
    @endif

    @if ($blog->user)
        <h5 class="text-danger"><strong>Author:</strong> {{ $blog->user->name }} </h5>
    @endif

    @if ($isLogin)
        {!! Form::open(array('url' => route('blogs.like', $blog->id), 'id' => 'form-like', 'onsubmit' => 'return false')) !!}
        {!! Form::submit('Like', ['class' => 'btn btn-danger btn-like-item', 'id' => 'delete-btn', 'data-id' => $blog->id], $blog->id) !!}
        {!! Form::close() !!}
    @endif
</div>