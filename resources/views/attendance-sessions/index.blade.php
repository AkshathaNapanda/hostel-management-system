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
                        <strong>{{ __('List of Attendances') }}</strong>
                        @if($isAttendanceSessionCompleted)
                            <button id="beginSessionButton" class="btn btn-success" onclick="beginSession()"><i class="fa fa-play"></i> Begin Session</button>
                            <button id="beginSessionDummyButton" class="btn btn-success d-none" type="button" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Please wait...
                            </button>
                        @else
                            <a href="{{ route('attendance-sessions.current') }}" class="btn btn-primary text-light"><i class="fa fa-eye"></i> Show Current Session</a>
                        @endif
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
                                <th>#</th>
                                <th>Begin</th>
                                <th>End</th>
                                <th>No. Of Present</th>
                                <th>No. Of Absent</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        @if(count($attendanceSessions) == 0)
                        <tbody>
                            <tr>
                                <td colspan="6" class="text-center">No Attendance Sessions available</td>
                            </tr>
                        </tbody>
                        @else
                        <tbody>
                            @foreach($attendanceSessions as $index => $attendanceSession)
                            <tr>
                                <td>{{ $index + $attendanceSessions->firstItem() }}</td>
                                <td>{{ date("d-m-Y / H:i:s", strtotime($attendanceSession->begin)) }}</td>
                                <td>{{ $attendanceSession->completed == 1 ? date("d-m-Y / H:i:s", strtotime($attendanceSession->end)) : 'Running' }}</td>
                                <td>{{ $attendanceSession->present($attendanceSession->id) }}</td>
                                <td>{{ $attendanceSession->absent($attendanceSession->id) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('attendance-sessions.show', ['attendance_session' => $attendanceSession->id]) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $attendanceSessions->links("pagination::bootstrap-4") }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function beginSession() {
        if (confirm("Are you sure you want to begin session?") == false) {
            return;
        }
        document.getElementById("beginSessionButton").classList.toggle("d-none");
        document.getElementById("beginSessionDummyButton").classList.toggle("d-none");
        window.location.href = href="{{ route('attendance-sessions.begin') }}";
    }
</script>
@endsection
