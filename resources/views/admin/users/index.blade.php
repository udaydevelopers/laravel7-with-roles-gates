@extends('layouts.admin')
@section('title','Users List:: Admin')

@section('content')

            <div class="card shadow mb-4">
                <div class="card-header">Users</div>

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
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                        <th scope="row">{{ $user->id}}</th>
                        <td>{{ $user->name}}</td>
                        <td>{{ $user->email}}</td>
                        <td> {{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                        <td><div style="width: 100%;padding-left: 15px;padding-right: 15px;">
                        @can('edit-users')
                        <a href="{{ route('admin.users.edit', $user->id) }}">
                        <button type="button" class="btn btn-primary float-left">Edit</button></a>
                        @endcan
                        @can('delete-users')
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                        @csrf
                        {{ method_field('DELETE')}}
                        <button type="submit" class="btn btn-warning float-left">Delete</button>
                        </form>
                        @endcan
                        </div></td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>

@endsection