
<!-- Blog Title -->
<div class="form-group">
    {!! Form::label('title', '', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('title', old('title'), ['class' => 'form-control', 'autofocus' => 'autofocus', 'id' => 'title', 'name' => 'title', 'files'=>true, 'enctype' => 'multipart/form-data']) !!}
        @if ($errors)
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
        @endif
    </div>
</div>

<!-- Blog Content -->
<div class="form-group">
    {!! Form::label('content', '', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'id' => 'content', 'name' => 'content']) !!}
        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<!-- Blog Image -->
<div class="form-group">
    {!! Form::label('image', 'Choose an image', ['class' => 'col-sm-3 control-label', 'id' => 'image', 'name' => 'image']) !!}
    <div class="col-sm-6">
        {!! Form::file('image') !!}
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<!-- Add Task Button -->
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-6">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-default', 'id' => 'create-blog']) !!}
    </div>
</div>