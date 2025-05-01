<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    
    /**
     * 資料表名稱
     */
    protected $table = 'news';
    
    /**
     * 可批量赋值的屬性
     */
    protected $fillable = [
        'title',
        'date',
        'link',
        'content'
    ];
    
    /**
     * 日期轉換
     */
    protected $casts = [
        'date' => 'date',
    ];
}