<!-- TODO: View Button -->
{!! link_to_route('admin.users.show', 'View', $data->id, ['class' => 'btn btn-normal']) !!}

<!-- TODO: View Button -->
{!! link_to_route('admin.users.edit', 'Edit role', $data->id, ['class' => 'btn btn-normal']) !!}

<!-- TODO: Delete Button -->
{!! Form::open(array('url' => route('admin.users.destroy', $data->id), 'method' => 'delete', 'id' => 'form-delete', 'onsubmit' => 'return false')) !!}
{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-delete-item', 'id' => 'delete-btn', 'data-id' => $data->id], $data->id) !!}
{!! Form::close() !!}