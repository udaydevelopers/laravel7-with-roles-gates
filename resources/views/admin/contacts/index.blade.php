@extends('layouts.admin')
@section('title')
Contact :: Admin
@endsection
@section('content')
            <div class="card shadow mb-4">
                <div class="card-header">Contacts</div>

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
                        <th scope="col">Subject</th>
                        <th scope="col">Message</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                        <th scope="row">{{ $contact->id}}</th>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td> {{ $contact->subject }}</td>
                        <td> {{ $contact->message }}</td>
                        <td><div style="width: 100%;padding-left: 15px;padding-right: 15px;">
                        @can('edit-contacts')
                        <a href="{{ route('admin.contacts.edit', $contact->id) }}">
                        <button type="button" class="btn btn-primary float-left">Edit</button></a>
                        @endcan
                        @can('delete-contacts')
                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="post">
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
                    {{ $contacts->links()}}
                </div>
            </div>

@endsection
@section('script')
  <!-- Page level plugins -->
  <script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('admin/js/demo/datatables-demo.js') }}"></script>
@endsection