@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Trending Tag</h3>
                    <div class="card-tools">
                        <a href="{{route('trendingtag')}}" class="btn btn-success">Refresh</a>
                        <a href="{{route('trendingtag.add')}}" class="btn btn-primary">Add Trending Tag</a>
                    </div>
                </div>
                <div class="card-body" style="overflow: auto;">
                    <table id="list-trendingtag" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Tag</th>
                                <th>Custom URL</th>
                                <th>Order</th>
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
    $('#list-trendingtag').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("list.trendingtag") }}',
        columns: [
            { data: 'trendingtagtitle', name: 'trendingtag.title'},
            { data: 'tagname', name: 'tag.name' },
            { data: 'custom_url', name: 'custom_url' },
            { data: 'order', name: 'order'},
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