<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
