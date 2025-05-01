<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Course;

class HomeController extends Controller
{
    private $news_items = [
        ['date' => '2025-05-01', 'title' => '【著作權法】教師課課著作權疑義，自學資源', 'link' => 'link1.php'],
        ['date' => '2025-04-21', 'title' => '網路社學教育訓練影片', 'link' => 'link2.php'],
        ['date' => '2025-04-14', 'title' => '網頁大事新增功能說明', 'link' => 'link3.php'],
        ['date' => '2025-03-23', 'title' => '教室環境中「同學資訊」頁面問題', 'link' => 'link4.php'],
        ['date' => '2025-02-01', 'title' => '如何刪除學生作答紀錄或複製試卷？', 'link' => 'link5.php'],
        ['date' => '2025-01-15', 'title' => '系統更新公告', 'link' => 'link6.php'],
        ['date' => '2025-01-10', 'title' => '這條不會顯示因為超過6條', 'link' => 'link7.php']
    ];

    public function index(Request $request)
    {
        $news_partial_item = array_slice($this->news_items, 0, 6);
    
        $sort = $request->query('sort', 'latest');
    
        $query = Course::with('teacher');
    
        if ($sort === 'popular') {
            $query->orderByDesc('popularity');
        } else {
            $query->orderBy('cid'); 
        }
    
        $courses = $query->take(8)->get();
    
        return view('home', [
            'courses' => $courses,
            'news_items' => $news_partial_item,
            'sort' => $sort, 
        ]);
    }


    public function allNews()
    {
        return view('news.all', [
            'news_items' => $this->news_items
        ]);
    }

    public function allCourses()
    {
        $courses = Course::with('teacher')->get();
    
        return view('courses.all', [
            'courses' => $courses
        ]);
    }
}
