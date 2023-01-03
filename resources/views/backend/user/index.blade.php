@extends('layouts.app')

@section('title')
    User | Manage
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
                <div class="card-header">{{ __('Users') }}
                    @if (Auth::user()->is_admin == 1)
                        <a href="{{ route('backend.create.user') }}" class="btn btn-sm btn-success">
                            Create
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {!! session('error') !!}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {!! session('success') !!}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <table id="dataTable" class="table table-bordered table-hover table-striped mb-0">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $item)
                          <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->is_admin }}</td>
                            <td>
                                @if (Auth::user()->is_admin == 0)
                                    @if (Auth::User()->name == $item->name)
                                        <a href="{{ route('backend.edit.user', $item->id) }}" class="btn btn-sm btn-success">
                                            <i class="fa-solid fa-pencil"></i> Edit
                                        </a>

                                        <form action="{{ route('backend.destroy.process.user', $item->id) }}" method="post" class="d-inline" >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt pe-1"></i> Destroy
                                            </button>
                                        </form>
                                    @endif
                                @endif
                                @if (Auth::user()->is_admin == 1)
                                    <a href="{{ route('backend.edit.user', $item->id) }}" class="btn btn-sm btn-success">
                                        <i class="fa-solid fa-pencil"></i> Edit
                                    </a>

                                    @if (Auth::User()->name != $item->name)
                                        <form action="{{ route('backend.destroy.process.user', $item->id) }}" method="post" class="d-inline" >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt pe-1"></i> Destroy
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </td>
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
