@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add News</h3>
                </div>
                <form class="form-vertical" method="post" enctype="multipart/form-data" action="{{route('news.store')}}">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
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
                            </div>
                            <div class="col-sm-6">
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
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Synopsis</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control {{ $errors->has('synopsis') ? ' is-invalid' : '' }}" name="synopsis" placeholder="Add Synopsis" required>
                                        @if($errors->has('synopsis'))
                                        <div class="text-danger">
                                            {{ $errors->first('synopsis')}}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tag</label>
                                    <div class="col-sm-9">
                                        <select class="select2" multiple="multiple" data-placeholder="Select news tags" name="tagId[]" style="width: 100%;" required>
                                            @foreach($tagCombo as $tagComboItem)
                                            <option value="{{ $tagComboItem->id }}">{{ $tagComboItem->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Date Publish</label>
                                    <div class="col-sm-9">
                                        <div class="input-group date form_datetime" data-date="{{ $dateNow }}">
                                            <input type="text" class="form-control {{ $errors->has('synopsis') ? ' is-invalid' : '' }}" name="datePublish" placeholder="Add Date Publish" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text input-group-addon"><i class="glyphicon-remove fas fa-trash"></i></span>
                                                <span class="input-group-text input-group-addon"><i class="glyphicon-th fas fa-th"></i></span>
                                            </div>
                                        </div>
                                        @if($errors->has('datePublish'))
                                        <div class="text-danger">
                                            {{ $errors->first('datePublish')}}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Editor</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" style="width: 100%;" name="editorId" required>
                                        <option value="">-</option>
                                            @foreach($userCombo as $userComboItem)
                                                <option value="{{ $userComboItem->id }}">{{ $userComboItem->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-3">Is Headline</label>
                                    <div class="col-sm-9">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="isHeadline" id="isHeadline">
                                            <label class="custom-control-label" for="isHeadline"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Reporter</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" style="width: 100%;" name="reporterId">
                                        <option value="">-</option>
                                            @foreach($userCombo as $userComboItem)
                                                <option value="{{ $userComboItem->id }}">{{ $userComboItem->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-3">Is Editor Pick</label>
                                    <div class="col-sm-9">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="isEditorPick" id="isEditorPick">
                                            <label class="custom-control-label" for="isEditorPick"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Photographer</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" style="width: 100%;" name="photographerId">
                                            <option value="">-</option>
                                            @foreach($userCombo as $userComboItem)
                                                <option value="{{ $userComboItem->id }}">{{ $userComboItem->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-3">Status</label>
                                    <div class="col-sm-9">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="status" id="status">
                                            <label class="custom-control-label" for="status"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Image Info</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control {{ $errors->has('imageinfo') ? ' is-invalid' : '' }}" name="imageinfo" placeholder="Add Image Info">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label class="col-form-label">Content</label>
                                    @if($errors->has('content'))
                                    <div class="text-danger">
                                        {{ $errors->first('content')}}
                                    </div>
                                    @endif
                                    <textarea class="textarea is-invalid" placeholder="Add Content" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="content"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
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
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <a href="{{route('news')}}" class="btn btn-default">Back to list</a>
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

    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss'});
    $('.textarea').summernote();
    $('.select2').select2();
});
</script>
@endpush