@extends('layouts.app')

@section('title')
    User | Create
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User | Create') }}</div>
                <div class="card-body">
                    <form id="contactForm" action="{{ route('backend.create.process.user') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">

                                <div class="mb-3">
                                    <div class="mb-2 @error('name') text-danger fw-bold @enderror">Name:</div>
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Name"
                                    class="form-control @error('name') text-danger is-invalid @enderror">
                                    @error('name')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 @error('email') text-danger fw-bold @enderror">Email:</div>
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                                    class="form-control @error('email') text-danger is-invalid @enderror">
                                    @error('email')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 @error('password') text-danger fw-bold @enderror">Password:</div>
                                    <input type="password" name="password" value="{{ old('password') }}" placeholder="Password"
                                    class="form-control @error('password') text-danger is-invalid @enderror">
                                    @error('password')
                                        <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="mb-2 @error('password') text-danger fw-bold @enderror">Confirm Password:</div>
                                        <input type="password" name="password_confirmation" value="{{ old('password') }}" placeholder="Password"
                                        class="form-control @error('password') text-danger is-invalid @enderror">
                                        @error('password')
                                        <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>
                                    @if (Auth::User()->is_admin == 1)
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Admin</label>
                                            <input class="form-check-input" type="radio" id="flexSwitchCheckDefault" name='is_admin' value='1'>
                                        </div>
                                    </div>
                                    @endif

                                    <button class="btn btn-dark">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
