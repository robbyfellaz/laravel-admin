@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Breaking News</h3>
                    <div class="card-tools">
                        <a href="{{route('breakingnews')}}" class="btn btn-success">Refresh</a>
                        <a href="{{route('breakingnews.add')}}" class="btn btn-primary">Add Breaking News</a>
                    </div>
                </div>
                <div class="card-body" style="overflow: auto;">
                    <table class="table table-bordered table-hover" id="list-breakingnews">
                        <thead>
                            <tr>
                                <th>Title</th>
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
    $('#list-breakingnews').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("list.breakingnews") }}',
        columns: [
            { data: 'title', name: 'title' },
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