<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'class', 'course', 'phone_no', 'email', 'address', 'admission_status'];

    public function guadrian($studentId) {
        return Guardian::where('student_id', $studentId)->first();
    }
}
