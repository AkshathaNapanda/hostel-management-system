@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            @include('layouts.sidenav')
        </div>
        <div class="col-sm-9">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <strong>{{ __('Attendances Session Details') }}</strong>
                        <a href="{{ route('attendance-sessions.index') }}" class="btn btn-primary text-light"><i class="fa fa-list"></i> Show All Sessions</a>
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
                                <th>Student Name</th>
                                <th>Student Id</th>
                                <th>Student Phone</th>
                                <th class="text-center">Present / Absent</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $index => $attendance)
                                <tr>
                                    <td>{{ $attendance->Student->name }}</td>
                                    <td>{{ $attendance->Student->id }}</td>
                                    <td>{{ $attendance->Student->phone_no }}</td>
                                    <th>
                                        <div class="d-grid">
                                            {!! $attendance->present == 1 ? '<button class="btn btn-success">Present</button>' : '<button class="btn btn-danger">Absent</button>' !!}
                                        </div>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="notes">Additional Notes</label>
                        <textarea name="notes" id="notes"class="form-control" readonly>{{ $attendanceSessions->notes }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
