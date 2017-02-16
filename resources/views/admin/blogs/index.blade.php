@extends('layouts.app')

@section('content')

<div class="panel-body">
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <a class="btn btn-default" href="{{ url('admin/blogs/create') }}">
                <i class="fa fa-plus"></i> Add Blog
            </a>
        </div>
    </div>
</div>

@if (count($blogs) > 0)
    <div class="panel panel-default">

        <div class="panel-body">
            <table class="table table-striped task-table datatable" id="datatableProj">

                <!-- Table Headings -->
                <thead>
                <th width="200">Title</th>
                <th width="400">Content</th>
                <th>Author</th>
                <th>Picture</th>
                <th>Created date</th>
                <th>&nbsp;</th>
                <tfoot>
                    <tr>
                        <th class="filter"></th>
                        <th class="filter"></th>
                        <th class="filter"></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                </thead>
                <!-- Table Body -->
                <tbody>
                @foreach ($blogs as $blog)
                    <tr class="item_{{ $blog->id }}">
                        <!-- Blog Title -->
                        <td class="table-text">
                            <div>{{ $blog->title }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $blog->content }}</div>
                        </td>
                        <td class="table-text">
                            @if ($blog->user)
                            <div> {{ $blog->user->name }} </div>
                            @endif
                        </td>
                        <td class="table-text">
                            @if ($blog->image)
                            <div><img src="{{ url('image/' . $blog->image) }}" width="100"/></div>
                            @endif
                        </td>
                        <td>
                            <div>{{ $blog->created_at }}</div>
                        </td>
                        <td>
                            <!-- TODO: View Button -->
                            {!! link_to_route('admin.blogs.show', 'View', $blog->id, ['class' => 'btn btn-normal']) !!}

                            <!-- TODO: View Button -->
                            {!! link_to_route('admin.blogs.edit', 'Edit', $blog->id, ['class' => 'btn btn-normal']) !!}

                            @if ($isAdmin)
                            <!-- TODO: Delete Button -->
                            {!! Form::open(array('url' => route('admin.blogs.destroy', $blog->id), 'method' => 'delete', 'id' => 'form-delete', 'onsubmit' => 'return false')) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-delete-item', 'id' => 'delete-btn', 'data-id' => $blog->id], $blog->id) !!}
                            {!! Form::close() !!}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection