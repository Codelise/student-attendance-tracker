<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'student_id', 'section', 'phone'];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
