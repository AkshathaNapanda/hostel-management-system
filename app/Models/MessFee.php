<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessFee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['email_count','amount', 'notes'];
}
