<!-- TODO: View Button -->
{!! link_to_route('admin.blogs.show', 'View', $data->id, ['class' => 'btn btn-normal']) !!}

<!-- TODO: View Button -->
{!! link_to_route('admin.blogs.edit', 'Edit', $data->id, ['class' => 'btn btn-normal']) !!}

@if ($isAdmin)
<!-- TODO: Delete Button -->
{!! Form::open(array('url' => route('admin.blogs.destroy', $data->id), 'method' => 'delete', 'id' => 'form-delete', 'onsubmit' => 'return false')) !!}
{!! Form::button('Delete', ['type' => 'button', 'class' => 'btn btn-danger btn-delete-item', 'id' => 'delete-btn', 'data-id' => $data->id], $data->id) !!}
{!! Form::close() !!}
@endif