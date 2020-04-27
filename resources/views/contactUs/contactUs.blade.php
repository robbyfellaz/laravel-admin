@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contact Us</h3>
                    <div class="card-tools">
                        <a href="{{route('contactus')}}" class="btn btn-success">Refresh</a>
                    </div>
                </div>
                <div class="card-body" style="overflow: auto;">
                    <table class="table table-bordered table-hover" id="list-contactus">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>E-mail</th>
                                <th>Phone</th>
                                <th>Content</th>
                                <th>Created Date</th>
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
    $('#list-contactus').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("list.contactus") }}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'address', name: 'address' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'content', name: 'content' },
            { data: 'created_at', name: 'created_at' },
        ],
        "autoWidth": false,
        "responsive": true,
    });
});
</script>
@endpush