@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            @include('layouts.sidenav')
        </div>
        <div class="col-sm-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <strong>{{ __('List of repositories') }}</strong>
                        <a href="{{ route('repositories.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (\Session::has('success'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {!! \Session::get('success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <table class="table table-striped table-bordered mb-3">
                        <thead class="bg-secondary text-light">
                            <tr>
                                <th>Id</th>
                                <th>Student Id</th>
                                <th>Student Name</th>
                                <th>Item</th>
                                <th>Stored On</th>
                                <th>Collected On</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        @if(count($repositories) == 0)
                        <tbody>
                            <tr>
                                <td colspan="7" class="text-center">No repository items added</td>
                            </tr>
                        </tbody>
                        @else
                        <tbody>
                            @foreach($repositories as $index => $repository)
                            <tr>
                                <td>{{ $index + $repositories->firstItem() }}</td>
                                <td>{{ $repository->student->id }}</td>
                                <td>{{ $repository->student->name }}</td>
                                <td>{{ $repository->item }}</td>
                                <td>{{ date("d-m-Y / H:i:s", strtotime($repository->stored_on)) }}</td>
                                <td>{{ $repository->repository_status == 0 ? date("d-m-Y / H:i:s", strtotime($repository->collected_on)) : 'Not yet' }}</td>
                                <td class="text-center">
                                    <div class="d-grid">
                                        @if ($repository->repository_status == 1)
                                            <a href="{{ route('repositories.update.repository-status', ['repository' => $repository->id]) }}" class="btn btn-success">Stored</a>
                                        @else
                                            <a href="{{ route('repositories.update.repository-status', ['repository' => $repository->id]) }}" class="btn btn-danger">Collected</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        @endif
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $repositories->links("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
