@extends('layouts.app')

@section('title')
    Portfolio | Backend
@endsection

@section('javascript')
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('table').DataTable({
                "pageLength" : 50
            });
        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Post') }}
                    <a href="{{ route('backend.create.post') }}" class="btn btn-sm btn-success">
                        Create
                    </a>
                </div>

                <div class="card-body">
                    @if (Session::has('error'))
                        <div class="alert alert-success">
                            {!! Session::get('error') !!}
                        </div>
                    @endif

                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {!! Session::get('success') !!}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <th>No</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th width="205">Action</th>
                            </thead>
                            @foreach ($posts as $key => $value)
                            <tbody>
                                <th>{{ ++$key }}</th>
                                <td>{{ $value->title }}</td>
                                <td>{{ $value->slug }}</td>
                                <td class="w-25"><img src="{{ asset('post') . '/' . $value->image }}" alt="" class="img-thumbnail"></td>
                                <td>{!! $value->description !!}</td>
                                <td>
                                    <a href="{{ route('backend.show.post', $value->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-search pe-1"></i> Show</a>
                                    <a href="{{ route('backend.edit.post', $value->id) }}" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt pe-1"></i> Edit</a>
                                    <form action="{{ route('backend.delete.post', $value->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt pe-1"> Destroy</i>
                                        </button>
                                    </form>
                                </td>
                            </tbody>
                            @endforeach
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
