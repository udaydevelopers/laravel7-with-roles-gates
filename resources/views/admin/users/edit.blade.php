@extends('layouts.admin')
@section('title','Edit Users :: Admin')

@section('content')

            <div class="card shadow mb-4">
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
                    <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="roles" class="col-md-4 col-form-label text-md-right">{{ __('Roles') }}</label>

                            <div class="col-md-6">
                            @foreach($roles as $role)
                            
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}" 
                            @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                            <label for="">{{ $role->name }}</label>
                        
                            @endforeach
                            </div>
                            </div>
                            <button type="submit" class="btn btn-primary offset-md-3">
                            Update
                            </button>
                            </form>
                </div>
            </div>
@endsection