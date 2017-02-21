<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div><h3>{{ $blog->title }}</h3></div>
        <h5>{{ $blog->content }}</h5>
        @if ($blog->image)
            <div><img src="{{ url('image/' . $blog->image) }}" width="70%"/></div>
        @endif

        @if ($isLogin)
            <br/>

            <div class="form_unlike_{{ $blog->id }} @if ($blog->isLiked == false) hideElement @endif">
            {!! Form::open(array('url' => route('blogs.unlike', $blog->id), 'id' => 'form-unlike', 'onsubmit' => 'return false')) !!}
            {!! Form::button('<i class="fa fa-thumbs-o-down"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-unlike-item', 'id' => 'like-btn', 'data-id' => $blog->id], $blog->id) !!}
            {!! Form::close() !!}
            </div>

            <div class="form_like_{{ $blog->id }} @if ($blog->isLiked == true) hideElement @endif">
            {!! Form::open(array('url' => route('blogs.like', $blog->id), 'id' => 'form-like', 'onsubmit' => 'return false')) !!}
            {!! Form::button('<i class="fa fa-thumbs-o-up"></i>', ['type' => 'button', 'class' => 'btn btn-info btn-like-item', 'id' => 'like-btn', 'data-id' => $blog->id], $blog->id) !!}
            {!! Form::close() !!}
            </div>
        @endif

        @if ($blog->user)
            <h6 class="text-danger"><strong>By:</strong> {{ $blog->user->name }} {{ $blog->created_at }}</h6>
        @else
            <h6 class="text-danger"><strong>By:</strong></h6>
        @endif
    </div>
</div>