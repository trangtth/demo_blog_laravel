<!-- Comment -->
<div class="form-group">
    {!! Form::label('body', 'Comment post:', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::textarea('body', old('body'), ['class' => 'form-control', 'id' => 'body', 'name' => 'body']) !!}
        {!! $errors->first('body', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<!-- Add Task Button -->
<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-default pull-right', 'id' => 'create-comment']) !!}
    </div>
</div>