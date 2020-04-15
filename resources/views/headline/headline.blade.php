@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Headline</h3>
                    <div class="card-tools">
                        <a href="{{route('headline')}}" class="btn btn-success">Refresh</a>
                        <a href="{{route('headline.add')}}" class="btn btn-primary">Add Headline</a>
                    </div>
                </div>
                <div class="card-body" style="overflow: auto;">
                    <table id="list-headline" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Label</th>
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
    $('#list-headline').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("list.headline") }}',
        columns: [
            { data: 'headlinetitle', name: 'headline.title'},
            { data: 'categorytitle', name: 'category.title' },
            { data: 'image', name: 'image', width: "12%" },
            { data: 'label', name: 'label' },
            { data: 'order', name: 'order' },
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