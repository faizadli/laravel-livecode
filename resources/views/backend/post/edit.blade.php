@extends('layouts.app')
@section('title')
    Post | Edit #ID {{ $posts->id }}
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('javascript')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(function () {
            $('#description').summernote({height: 200});

            $("input[name=image]").change(function() {
                imagePreview(this);
            });

            $('input[name="title"]').on('keyup', function(){
                let Text = $(this).val();

                Text = Text.toLowerCase();
                Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');

                $('input[name="slug"]').val(Text);
            });

            function imagePreview(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $("#preview").removeClass("d-none");
                        $('#preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Post | Edit #ID {{ $posts->id }}</div>
                    <div class="card-body">
                        <form action="{{ route('backend.edit.process.post', $posts->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $posts->id }}">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                    <div class="mb-3">
                                        <div class="mb-2 @error('title') text-danger fw-bold @enderror">Title:</div>
                                        <input type="text" name="title" value="{{ $posts->title }}" placeholder="Title" class="form-control @error('title') text-danger is-invalid @enderror">
                                        @error('title')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="mb-2 @error('slug') text-danger fw-bold @enderror">Slug:</div>
                                        <input type="text" name="slug" value="{{ $posts->slug }}" placeholder="Slug" class="form-control @error('slug') text-danger is-invalid @enderror">
                                        @error('slug')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="mb-2 @error('image') text-danger fw-bold @enderror">Image:</div>
                                        <div class="mb-3">
                                            <img src="{{ asset('post/'.$posts->image) }}" class="w-25">
                                        </div>
                                        <input class="form-control" type="file" name="image" id="image">
                                        <img class="img-thumbnail mt-3 mb-3 d-none w-50" id="preview" src="">
                                        @error('image')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="mb-2 @error('description') text-danger fw-bold @enderror">Description:</div>
                                        <textarea class="form-control @error('description') text-danger is-invalid @enderror" name="description" id="description" placeholder="description">
                                            {{ $posts->description }}
                                        </textarea>
                                        @error('description')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-dark">Edit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
