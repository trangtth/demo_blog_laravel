@extends('layouts.app')

@section('content')

@if (count($blogs) > 0)
<div class="row list-blog">
    @foreach ($blogs as $blog)
        @include ('frontend.blogs.item', ['blog' => $blog])
    @endforeach
</div>
<div class="row">
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="col-md-6 col-md-offset-3 hidden">
        {!! Form::open(array('url' => route('blogs.loadmore'), 'id' => 'form-load', 'onsubmit' => 'return false')) !!}
        {!! Form::submit('View more', ['class' => 'btn btn-info btn-view-more', 'id' => 'view-more-btn']) !!}
        {!! Form::close() !!}
    </div>
</div>
<div class="hideElement txtCenter loading-ajax-data">
    <img src="{{ url('lib_images/spin.gif') }}" class="hideElement"/>
</div>
@endif
@endsection