<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceSession extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'begin', 'end', 'notes', 'completed'];

    public function present($attendanceSessionId)
    {
        return Attendance::where([['present', 1], ['attendance_session_id', $attendanceSessionId]])->get()->count();
    }

    public function absent($attendanceSessionId)
    {
        return Attendance::where([['present', 0], ['attendance_session_id', $attendanceSessionId]])->get()->count();
    }
}
