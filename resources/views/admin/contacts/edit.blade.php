@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-3">
    <!-- Sidebar -->
    @include('layouts.navbar')
    </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Contact Edit - {{ $contact->name}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('admin.contacts.update', $contact) }}">
                            @csrf
                            {{ method_field('PUT')}}
                    <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $contact->name }}" required autocomplete="email" autofocus>

                            </div>
                        </div>
                    <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $contact->email }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="roles" class="col-md-4 col-form-label text-md-right">{{ __('Subject') }}</label>

                            <div class="col-md-6">
                            <select id="subject" name="subject" class="form-control" required="required">
                                <option value="na" selected="">Choose One:</option>
                                <option value="service" @if($contact->subject == "service") selected @endif>General Customer Service</option>
                                <option value="suggestions" @if($contact->subject == "suggestions") selected @endif>Suggestions</option>
                                <option value="product" @if($contact->subject == "product") selected @endif>Product Support</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="roles" class="col-md-4 col-form-label text-md-right">{{ __('Message') }}</label>

                            <div class="col-md-6">
                            <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message" required autocomplete="message" autofocus>{{ $contact->message}}</textarea>
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary offset-md-3">
                            Update
                            </button>
                            </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection