<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Teacher extends Authenticatable 
{
    
    use HasFactory, Notifiable;

    protected $table = 'teacher';    
    protected $primaryKey = 'tid';    
    public $incrementing = false;     // 因為 cid 是字串，不是自動遞增數字
    protected $keyType = 'string';    // 主鍵型別是 string
    protected $fillable = ['tid', 'name', 'email', 'password', 'department']; 
    protected $hidden = ['password', 'token',];
}