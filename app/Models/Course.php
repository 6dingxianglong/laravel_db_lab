<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'course';      
    protected $primaryKey = 'cid';    // 告訴 Laravel 用 cid 當主鍵
    public $incrementing = false;     // 因為 cid 是字串，不是自動遞增數字
    protected $keyType = 'string';    // 主鍵型別是 string
    protected $fillable = ['cid', 'tid', 'name', 'description', 'popularity']; 

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'tid', 'tid');
    }
}