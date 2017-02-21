@extends('layouts.app')

@section('content')

<div class="row">
    <div class="panel-body">
        {!! $dataTable->table(['class' => 'table table-striped dataTable', 'id' => 'datatableUsers'], true) !!}
    </div>
</div>
@endsection