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
                        <strong>{{ __('Current Attendances Session') }}</strong>
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
                                <th class="text-center">Present</th>
                                <th class="text-center">Absent</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->Student->name }}</td>
                                    <td>{{ $attendance->Student->id }}</td>
                                    <td>{{ $attendance->Student->phone_no }}</td>
                                    <th>
                                        <div class="d-grid">
                                            <a href="{{ route('attendances.update.present', ['attendance' => $attendance->id]) }}" class="btn {{ $attendance->present == 1 ? 'btn-success' : 'btn-outline-success' }}">Present</a>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="d-grid">
                                            <a href="{{ route('attendances.update.absent', ['attendance' => $attendance->id]) }}" class="btn {{ $attendance->present == 0 ? 'btn-danger' : 'btn-outline-danger' }}">Absent</a>
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
                    <form id="attendanceForm" action="{{ route('attendance-sessions.end') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="notes">Additional Notes</label>
                            <textarea name="notes" id="notes"class="form-control" placeholder="Any notes or remarks"></textarea>
                        </div>
                        <button id="endSessionButton" onclick="endSession()" type="button" class="btn btn-danger text-light"><i class="fa fa-stop"></i> End Current Session</button>
                        <button id="endSessionDummyButton" class="btn btn-danger text-light d-none" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Please wait...
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function endSession() {
        if (confirm("Are you sure you want to end session?") == false) {
            return;
        }
        document.getElementById("endSessionButton").classList.toggle("d-none");
        document.getElementById("endSessionDummyButton").classList.toggle("d-none");
        document.getElementById("attendanceForm").submit();
    }
</script>
@endsection
