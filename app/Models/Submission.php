<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'submits';
    protected $primaryKey = 'sid';
    protected $keyType = 'string';    // 主鍵型別是 string   
    public $incrementing = false;     // 因為 cid 是字串，不是自動遞增數字
    public $timestamps = false; 

    protected $fillable = [
        'sid',
        'assid',
        'score',
        'feedback',
        'url',
        'submit_date',
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assid', 'assid');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'sid', 'sid');
    }
}
