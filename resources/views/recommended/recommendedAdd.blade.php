@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Recommended</h3>
                </div>
                <form class="form-vertical" method="post" enctype="multipart/form-data" action="{{route('recommended.store')}}">
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
                            <label class="col-sm-3 col-form-label">URL</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control {{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" placeholder="Add URL" required>
                                @if($errors->has('url'))
                                <div class="text-danger">
                                    {{ $errors->first('url')}}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input {{ $errors->has('image') ? ' is-invalid' : '' }}" id="image" name="image" required>
                                    <label class="custom-file-label" for="image">Upload image</label>
                                    @if($errors->has('image'))
                                    <div class="text-danger">
                                        {{ $errors->first('image')}}
                                    </div>
                                    @endif
                                </div>
                                <div class="attachment-block clearfix" style="margin-top: 5px;">
                                    <img class="img-fluid pad" id="image_preview_container" src="https://mysocialtab.com/imagesNew/no-preview.jpg" alt="preview image">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-9">
                            <select class="form-control select2" style="width: 100%;" name="categoryId">
                                @foreach($categoryCombo as $categoryComboItem)
                                    <option value="{{ $categoryComboItem->id }}">{{ $categoryComboItem->title }}</option>
                                @endforeach
                            </select>
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
                        <a href="{{route('recommended')}}" class="btn btn-default">Back to list</a>
                        <button type="submit" class="btn btn-success float-right">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script type="text/javascript">
$(document).ready(function (e) {
    bsCustomFileInput.init();

    $('#image').change(function(){
        $('#image_preview_container').attr('src', 'https://mysocialtab.com/imagesNew/no-preview.jpg');
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#image_preview_container').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });
});
</script>
@endpush