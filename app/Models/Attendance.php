<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['student_id', 'present', 'attendance_session_id'];

    public function student() {
        return $this->hasOne('App\Models\Student', 'id', 'student_id')->withTrashed();
    }
}
