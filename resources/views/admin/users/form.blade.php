{{ csrf_field() }}

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">Name</label>

    <div class="col-md-6">
        {!! Form::text('name', old('name'), ['class' => 'form-control', 'autofocus' => 'autofocus', 'id' => 'name', 'files' => true, 'disabled' => 'disabled']) !!}

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">Role</label>

    <div class="col-md-6">
        {!! Form::select('role', $roleUser, $users->role, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-default', 'id' => 'create-user']) !!}
    </div>
</div>