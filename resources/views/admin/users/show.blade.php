@extends('layouts.app')

@section('content')

    <div class="panel-body">
        <article>
            <h2>Name: {{ $users->name }}</h2>
            <h4>Username: {{ $users->username }}</h4>
            <h4>Email: {{ $users->email }}</h4>
            <h4>Role: {{ $users->role }}</h4>
        </article>
        <p>{!! link_to_route('admin.users.index', 'Back to list users') !!}</p>

    </div>

@endsection