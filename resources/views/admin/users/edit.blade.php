@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Edit - {{ $user->name}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
      <form method="POST" action="{{ route('admin.users.update', $user) }}">
      @csrf
      {{ method_field('PUT')}}
      
      @foreach($roles as $role)
      <div class="form-check">
      <input type="checkbox" name="roles[]" value="{{ $role->id }}">
      <label for="">{{ $role->name }}</label>
      </div>
      @endforeach
      <button class="btn btn-primary">
      Update
      </button>
      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection