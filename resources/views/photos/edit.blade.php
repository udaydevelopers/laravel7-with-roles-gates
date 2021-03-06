@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Photo</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
         
                <form method="post" action="{{ route('photos.update', $photo->id) }}" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT')}}
                <div class="form-group">
                    <label for="exampleFormControlFile1">Select file to upload</label>
                    <input type="file" class="form-control-file" name="image" value="">
                </div>
                <div class="form-group"><button type="submit" name="button">Upload</button></div>
                </form>
                <img src="{{ $photo->image }}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection