@extends('layouts.app')

@section('title')
    User | Edit
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User | Update') }}</div>
                <div class="card-body">
                    <form id="contactForm" action="{{ route('backend.edit.process.user') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <input type="hidden" value="{{$item->id}}" name="id">

                                <div class="mb-3">
                                    <div class="mb-2 @error('name') text-danger fw-bold @enderror">Name:</div>
                                    <input type="text" name="name" value="{{ $item->name }}" placeholder="Name"
                                    class="form-control @error('name') text-danger is-invalid @enderror">
                                    @error('name')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 @error('email') text-danger fw-bold @enderror">Email</div>
                                    <input type="email" name="email" value="{{ $item->email}}" placeholder="Email"
                                    class="form-control @error('email') text-danger is-invalid @enderror">
                                    @error('email')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 @error('password') text-danger fw-bold @enderror">Password</div>
                                    <input type="password" name="password" value="{{ old('password') }}" placeholder="Password"
                                    class="form-control @error('password') text-danger is-invalid @enderror">
                                    @error('password')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                <button class="btn btn-dark">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
