
<!-- Blog Title -->
<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    {!! Form::label('title', '', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('title', old('title'), ['class' => 'form-control', 'autofocus' => 'autofocus', 'id' => 'title', 'name' => 'title', 'files' => true, 'enctype' => 'multipart/form-data']) !!}
        @if ($errors)
        {!! $errors->first('title', '<span class="help-block"><strong>:message</strong></span>') !!}
        @endif
    </div>
</div>

<!-- Blog Content -->
<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
    {!! Form::label('content', '', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'id' => 'content', 'name' => 'content']) !!}
        {!! $errors->first('content', '<span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

<!-- Blog Image -->
<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
    {!! Form::label('image', 'Choose an image', ['class' => 'col-sm-3 control-label', 'id' => 'image', 'name' => 'image']) !!}
    <div class="col-sm-6">
        {!! Form::file('image') !!}
        {!! $errors->first('image', '<span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

<!-- Add Task Button -->
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-6">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-default', 'id' => 'create-blog']) !!}
    </div>
</div>