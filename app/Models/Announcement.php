<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = 'announcement';      
    protected $primaryKey = 'annid';    
    protected $fillable = ['annid', 'cid', 'title', 'content', 'timestamp']; 

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'tid', 'tid');
    }
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'cid', 'cid');
    }
}