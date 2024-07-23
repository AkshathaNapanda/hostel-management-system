<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repository extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['student_id', 'item', 'repository_status', 'stored_on', 'collected_on'];

    public function student() {
        return $this->hasOne('App\Models\Student', 'id', 'student_id')->withTrashed();
    }
}
