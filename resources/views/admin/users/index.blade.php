@extends('layouts.app')

@section('content')

@if (count($users) > 0)
    <div class="panel panel-default">

        <div class="panel-body">
            <table class="table table-striped task-table datatable" id="datatableProj">

                <!-- Table Headings -->
                <thead>
                <th width="200">Name</th>
                <th width="400">Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>&nbsp;</th>
                <tfoot>
                    <tr>
                        <th class="filter"></th>
                        <th class="filter"></th>
                        <th class="filter"></th>
                        <th class="filter"></th>
                        <th></th>
                    </tr>
                </tfoot>
                </thead>
                <!-- Table Body -->
                <tbody>
                @foreach ($users as $user)
                    <tr class="item_{{ $user->id }}">
                        <!-- Blog Title -->
                        <td class="table-text">
                            <div>{{ $user->name }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $user->username }}</div>
                        </td>
                        <td class="table-text">
                            <div> {{ $user->email }} </div>
                        </td>
                        <td class="table-text">
                            <div> {{ $roleUser[$user->role] }} </div>
                        </td>
                        <td>
                            <!-- TODO: View Button -->
                            {!! link_to_route('admin.users.show', 'View', $user->id, ['class' => 'btn btn-normal']) !!}

                            <!-- TODO: View Button -->
                            {!! link_to_route('admin.users.edit', 'Edit role', $user->id, ['class' => 'btn btn-normal']) !!}

                            <!-- TODO: Delete Button -->
                            {!! Form::open(array('url' => route('admin.users.destroy', $user->id), 'method' => 'delete', 'id' => 'form-delete', 'onsubmit' => 'return false')) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-delete-item', 'id' => 'delete-btn', 'data-id' => $user->id], $user->id) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection