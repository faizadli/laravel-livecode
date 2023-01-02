@extends('layouts.app')

@section('title')
    @if (Session::has('error'))
        {!! Session::get('error') !!}
    @endif
@endsection

@section('content')
    <section class="page-section" id="contact">
        <div class="container">
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Error 404</h2>
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <div class="row justify-content-center">

                Erorr bang 404
                {{-- <div class="col-lg-8 col-xl-7 text-center lead text-muted">
                    @if (Session::has('error'))
                        {!! Session::get('error') !!}
                    @else
                        <a href="/" class="btn btn-dark">
                            <i class="fas fa-home pe-1"></i>Back to Home
                        </a>
                    @endif
                </div> --}}
            </div>
        </div>
    </section>
@endsection

@section('css')
    <style>
        .page-section {
            padding: 13rem 0 6rem 0 !important;
        }
    </style>
@endsection

@section('javascript')

@endsection

