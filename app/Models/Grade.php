<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $primaryKey = 'gid';
    public $timestamps = false; 

    protected $fillable = [
        'sid',
        'cid',
        'assid',
        'score',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'sid', 'sid');
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assid', 'assid');
    }
}
