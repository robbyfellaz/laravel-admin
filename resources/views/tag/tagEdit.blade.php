@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Tag</h3>
                </div>
                <form class="form-horizontal" method="post" action="{{route('tag.update', $tag->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Tag Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" placeholder="Tag Name" value="{{ $tag->name }}">
                                @if($errors->has('name'))
                                <div class="text-danger">
                                    {{ $errors->first('name')}}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Tag URL</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="url" placeholder="Tag URL" value="{{ $tag->url }}">
                                @if($errors->has('url'))
                                <div class="text-danger">
                                    {{ $errors->first('url')}}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('tag')}}" class="btn btn-default">Back to list</a>
                        <button type="submit" class="btn btn-success float-right">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection