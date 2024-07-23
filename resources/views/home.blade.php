@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            @include('layouts.sidenav')
        </div>
        <div class="col-sm-9">
            <div class="card">
                <div class="card-header"><strong>{{ __('Home') }}</strong></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Hello {{ Auth::user()->name }}, {{ __('You are logged in!') }}

                    <table class="table table-bordered my-3">
                        <thead>
                            <tr>
                                <th colspan="2" class="bg-secondary text-center text-light">Overview</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="w-50 bg-light">Students (Active)</th>
                                <td class="w-50">{{ App\Models\Student::where('admission_status', 1)->count() }}</td>
                            </tr>
                            <tr>
                                <th class="w-50 bg-light">Students registered</th>
                                <td class="w-50">{{ App\Models\Student::count() }}</td>
                            </tr>
                            <tr>
                                <th class="w-50 bg-light">Attendance sessions</th>
                                <td class="w-50">{{ App\Models\AttendanceSession::count() }}</td>
                            </tr>
                            <tr>
                                <th class="w-50 bg-light">Total Mess fees emails sent</th>
                                <td class="w-50">{{ App\Models\MessFee::all()->sum('email_count') }}</td>
                            </tr>
                            <tr>
                                <th class="w-50 bg-light">Items stored in repository</th>
                                <td class="w-50">{{ App\Models\Repository::where('repository_status', 1)->count() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
