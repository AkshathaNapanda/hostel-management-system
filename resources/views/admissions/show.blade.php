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
                        <strong>{{ __('Admission Details') }}</strong>
                        <a href="{{ route('admissions.index') }}" class="btn btn-primary"><i class="fa fa-list"></i> Show All</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="bg-secondary text-light" colspan="2">Student Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="w-25 bg-light">ID</th>
                                <td class="w-75">{{ $student->id }}</td>
                            </tr>
                            <tr>
                                <th class="w-25 bg-light">Name</th>
                                <td class="w-75">{{ $student->name }}</td>
                            </tr>
                            <tr>
                                <th class="w-25 bg-light">Class</th>
                                <td class="w-75">{{ $student->class }}</td>
                            </tr>
                            <tr>
                                <th class="w-25 bg-light">Course</th>
                                <td class="w-75">{{ $student->course  }}</td>
                            </tr>
                            <tr>
                                <th class="w-25 bg-light">Phone</th>
                                <td class="w-75">{{ $student->phone_no  }}</td>
                            </tr>
                            <tr>
                                <th class="w-25 bg-light">Email</th>
                                <td class="w-75">{{ $student->email  }}</td>
                            </tr>
                            <tr>
                                <th class="w-25 bg-light">Address</th>
                                <td class="w-75">{{ $student->address  }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="bg-secondary text-light" colspan="2">Parent / Guardian Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="w-25 bg-light">Name</th>
                                <td class="w-75">{{ $guardian->name }}</td>
                            </tr>
                            <tr>
                                <th class="w-25 bg-light">Email</th>
                                <td class="w-75">{{ $guardian->email }}</td>
                            </tr>
                            <tr>
                                <th class="w-25 bg-light">Address</th>
                                <td class="w-75">{{ $guardian->address  }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
