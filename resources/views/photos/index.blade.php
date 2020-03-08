@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Photos</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Path</th>
                        <th scope="col">Upload Date</th>
                        <th scope="col"><a href="{{route('photos.create')}}">Add New</a></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($photos as $photo)
                        <tr>
                        <th scope="row">1</th>
                        <td>{{ $photo->name}}</td>
                        <td><img src="{{ storage_path('/storage/app/'.$photo->image_path)}}"></td>
                        <td >{{ $photo->created_at->format('d-m-Y')}}</td>
                        <td style="float:left; width:160px"><button type="button" class="btn btn-primary">Edit</button>
                        <button type="button" class="btn btn-warning">Delete</button></td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection