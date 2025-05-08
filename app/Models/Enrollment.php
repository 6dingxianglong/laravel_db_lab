<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Course;

class Enrollment extends Model
{
    protected $table = 'enrollment'; 

    public $timestamps = false;

    protected $fillable = ['sid', 'cid', 'created_at']; 

    public function student()
    {
        return $this->belongsTo(Student::class, 'sid', 'sid');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'cid', 'cid');
    }
}
