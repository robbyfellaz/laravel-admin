@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User</h3>
                    <div class="card-tools">
                        <a href="{{route('user')}}" class="btn btn-success">Refresh</a>
                        <a href="{{route('user.add')}}" class="btn btn-primary">Add User</a>
                    </div>
                </div>
                <div class="card-body" style="overflow: auto;">
                    <table id="list-user" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Phone</th>
                                <th>Group</th>
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
    $('#list-user').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("list.user") }}',
        columns: [
            { data: 'username', name: 'users.name'},
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'groupname', name: 'group.name'},
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        "autoWidth": false,
        "responsive": true,
    });
});
</script>
@endpush