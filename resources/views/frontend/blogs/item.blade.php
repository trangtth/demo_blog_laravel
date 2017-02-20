<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div><h3>{{ $blog->title }}</h3></div>
        @if ($blog->user)
            <h6 class="text-danger"><strong>Author:</strong> {{ $blog->user->name }} </h6>
        @else
            <h6 class="text-danger"><strong>Author:</strong></h6>
        @endif
        <h6>Created date: {{ $blog->created_at }}</h6>
        <h5>{{ $blog->content }}</h5>
        @if ($blog->image)
            <div><img src="{{ url('image/' . $blog->image) }}" width="70%"/></div>
        @endif

        @if ($isLogin)
            <br/>
            @if ($blog->isLiked == true)
            <div class="form_unlike_{{ $blog->id }}">
            {!! Form::open(array('url' => route('blogs.unlike', $blog->id), 'id' => 'form-unlike', 'onsubmit' => 'return false')) !!}
            {!! Form::button('<i class="fa fa-thumbs-o-down"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-unlike-item', 'id' => 'like-btn', 'data-id' => $blog->id], $blog->id) !!}
            {!! Form::close() !!}
            </div>
            @endif

            @if ($blog->isLiked == false)
            <div class="form_like_{{ $blog->id }}">
            {!! Form::open(array('url' => route('blogs.like', $blog->id), 'id' => 'form-like', 'onsubmit' => 'return false')) !!}
            {!! Form::button('<i class="fa fa-thumbs-o-up"></i>', ['type' => 'button', 'class' => 'btn btn-info btn-like-item', 'id' => 'like-btn', 'data-id' => $blog->id], $blog->id) !!}
            {!! Form::close() !!}
            @endif
            </div>
        @endif
    </div>
</div>