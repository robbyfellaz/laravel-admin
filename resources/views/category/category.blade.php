@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">News Category</h3>
                    <div class="card-tools">
                        <a href="{{route('category')}}" class="btn btn-success">Refresh</a>
                        <a href="{{route('category.add')}}" class="btn btn-primary">Add Category</a>
                    </div>
                </div>
                <div class="card-body" style="overflow: auto;">
                    <table class="table table-bordered table-hover" id="list-category">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>URL</th>
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
    $('#list-category').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("list.category") }}',
        columns: [
            { data: 'title', name: 'title' },
            { data: 'url', name: 'url' },
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