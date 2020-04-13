@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add New Category</h3>
                </div>
                <form class="form-horizontal" method="post" action="{{route('category.store')}}">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" placeholder="Add Title" required>
                                @if($errors->has('title'))
                                <div class="text-danger">
                                    {{ $errors->first('title')}}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="3" name="desc" placeholder="Add Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3">Status</label>
                            <div class="col-sm-9">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="status" id="status" checked>
                                    <label class="custom-control-label" for="status"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('category')}}" class="btn btn-default">Back to list</a>
                        <button type="submit" class="btn btn-success float-right">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection