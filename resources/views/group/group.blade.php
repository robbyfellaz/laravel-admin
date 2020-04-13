@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Group</h3>
                    <div class="card-tools">
                        <a href="{{route('group.add')}}" class="btn btn-primary">Add Group</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover" id="list-group">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Last Modified</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script>
$(function() {
    $('#list-group').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("list.group") }}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'desc', name: 'desc' },
            { data: 'status', name: 'status' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        "autoWidth": false,
        "responsive": true,
    });
});
</script>
@endpush