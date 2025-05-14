<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TA extends Authenticatable 
{
    use HasFactory;

    protected $table = 'ta';    
    protected $primaryKey = 'cid';    
    public $incrementing = false;     // 因為 cid 是字串，不是自動遞增數字
    protected $keyType = 'string';    // 主鍵型別是 string
    protected $fillable = ['sid', 'cid', 'timestamp']; 

    public function course()
    {
        return $this->belongsTo(Course::class, 'cid', 'cid');
    }
    
    public function student()
    {
        return $this->belongsTo(Student::class, 'sid', 'sid');
    }
}