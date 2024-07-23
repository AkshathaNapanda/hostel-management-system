<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AttendanceMail;
use App\Models\AttendanceSession;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Guardian;
use Carbon\Carbon;

class AttendanceSessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $isAttendanceSessionCompleted = true;
        $attendanceSession = AttendanceSession::orderBy('id', 'DESC')->first();
        if($attendanceSession) {
            $isAttendanceSessionCompleted = $attendanceSession->completed;
        }
        return view('attendance-sessions.index', [
            'isAttendanceSessionCompleted' => $isAttendanceSessionCompleted,
            'attendanceSessions' => AttendanceSession::orderBy('id', 'DESC')->paginate(10)
        ]);
    }

    public function show($id)
    {
        return view('attendance-sessions.show', [
            'attendanceSessions' => AttendanceSession::where('id', $id)->first(),
            'attendances' => Attendance::where('attendance_session_id', $id)->get()
        ]);
    }

    public function begin()
    {
        $attendanceSession = new AttendanceSession();
        $attendanceSession->user_id = auth()->id();
        $attendanceSession->begin = date('Y-m-d H:i:s');
        $attendanceSession->save();

        $students = Student::where('admission_status', 1)->orderBy('name', 'ASC')->get();
        $students->each(function($student) use ($attendanceSession) {
            Attendance::create([
                'student_id' => $student->id,
                'attendance_session_id' => $attendanceSession->id
            ]);
        });

        return redirect()->route('attendance-sessions.index')->with('success', 'Attendance session is started');
    }

    public function current()
    {
        $attendanceSession = AttendanceSession::orderBy('id', 'DESC')->first();
        return view('attendance-sessions.current', [
            'attendances' => Attendance::where('attendance_session_id', $attendanceSession->id)->get()
        ]);
    }

    public function end(Request $request)
    {
        $attendanceSession = AttendanceSession::where('completed', 0)->orderBy('id', 'DESC')->first();
       
        $attendances = Attendance::where('attendance_session_id', $attendanceSession->id)->get();
        foreach($attendances as $attendance) {
            if($attendance->present == 0) {
                $student = Student::where('id', $attendance->student_id)->first();
                $guardian = Guardian::where('student_id', $attendance->student_id)->first();
                $details = [
                    'studentName' => $student->name,
                    'guardianName' => $guardian->name,
                    'date' => date('d-m-Y')
                ];
                Mail::to($guardian->email)->send(new AttendanceMail($details));
            }
        }

        $attendanceSession->end = date('Y-m-d H:i:s');
        $attendanceSession->notes = $request->notes ?? '';
        $attendanceSession->completed = true;
        $attendanceSession->save();
        return redirect()->route('attendance-sessions.index')->with('success', 'Attendance session was ended successfully');
    }
}
