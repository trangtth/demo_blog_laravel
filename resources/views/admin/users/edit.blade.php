@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">User</div>
                    <div class="panel-body">
                        @if ($users)
                        <!-- Display Validation Errors -->
                        @include('common.errors')

                        <!-- New Blog Form -->
                        {!! Form::model($users, ['method' => 'PATCH', 'route' => ['admin.users.update', $users->id], 'id' => 'user-form', 'name' => 'user-form', 'class' => 'form-horizontal']) !!}

                        @include ('admin.users.form', ['submitButtonText' => 'Update User'])

                        {!! Form::close() !!}
                        @else
                            Blog not found
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
