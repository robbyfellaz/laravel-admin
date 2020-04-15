@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">News</h3>
                    <div class="card-tools">
                        <a href="{{route('news')}}" class="btn btn-success">Refresh</a>
                        <a href="{{route('news.add')}}" class="btn btn-primary">Add News</a>
                    </div>
                </div>
                <div class="card-body" style="overflow: auto;">
                    <table id="list-news" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Date Publish</th>
                                <th>Editor</th>
                                <th>Is Headline?</th>
                                <th>Is Editor Pick?</th>
                                <th>Status</th>
                                <!-- <th>Last Modified</th>
                                <th>Created Date</th> -->
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
    $('#list-news').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("list.news") }}',
        columns: [
            { data: 'newstitle', name: 'news.title'},
            { data: 'categorytitle', name: 'category.title' },
            { data: 'image', name: 'image', width: "12%" },
            { data: 'datePublish', name: 'label' },
            { data: 'editorname', name: 'users.name' },
            { data: 'isHeadline', name: 'isHeadline' },
            { data: 'isEditorPick', name: 'isEditorPick' },
            { data: 'status', name: 'status' },
            // { data: 'created_at', name: 'created_at' },
            // { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        "autoWidth": false,
        "responsive": true,
    });
});
</script>
@endpush