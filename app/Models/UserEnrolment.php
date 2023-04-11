<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEnrolment extends Model
{
    use HasFactory;
    public $table = 'user_enrolment';
    protected $guarded = ['id']; 
}