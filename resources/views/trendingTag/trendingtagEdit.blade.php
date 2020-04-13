@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Trending Tag</h3>
                </div>
                <form class="form-horizontal" method="post" action="{{route('trendingtag.update', $trendingtag->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" placeholder="Add Title" value="{{ $trendingtag->title }}" required>
                                @if($errors->has('title'))
                                <div class="text-danger">
                                    {{ $errors->first('title')}}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tag</label>
                            <div class="col-sm-9">
                            <select class="form-control select2" style="width: 100%;" name="tagId">
                                @foreach($tagCombo as $tagComboItem)
                                    <option value="{{ $tagComboItem->id }}" {{ $tagComboItem->id == $trendingtag->tagId ? 'selected' : '' }}>{{ $tagComboItem->name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Custom URL</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control {{ $errors->has('custom_url') ? ' is-invalid' : '' }}" name="custom_url" placeholder="Add Custom URL" value="{{ $trendingtag->custom_url }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Order</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control {{ $errors->has('order') ? ' is-invalid' : '' }}" name="order" placeholder="Add Order" value="{{ $trendingtag->order }}" required>
                                @if($errors->has('order'))
                                <div class="text-danger">
                                    {{ $errors->first('order')}}
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-3">Status</label>
                            <div class="col-sm-9">
                                <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="status" id="status" {{ $trendingtag->status === "Active" ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="status"></label>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <a href="{{route('trendingtag')}}" class="btn btn-default">Back to list</a>
                        <button type="submit" class="btn btn-success float-right">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script>
$(function () {
    $('.select2').select2()
})
</script>
@endpush