<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Enrollment;

class Assignment extends Model
{
    protected $table = 'assignment'; 

    protected $primaryKey = 'assid'; 

    public $timestamps = false; 

    protected $fillable = [
        'assid',
        'cid',
        'title',
        'description',
        'deadline',
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'cid', 'cid');
    }
}
