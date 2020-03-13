@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
            @if($errors->any())
                    <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif
                <div class="card-header">Photos</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{url('upload')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group col-md-4">
            <label for="title">Title:</label>
            <input type="text" class="form-control" name="title">
        </div>
        <div class="form-group col-md-4">
            <label for="document">Document:</label>
            <input type="file" class="form-control" name="document">
        </div>
                   <button type="submit" class="btn btn-success">Upload</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection