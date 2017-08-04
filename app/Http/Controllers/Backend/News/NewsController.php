<?php

namespace App\Http\Controllers\Backend\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\News;
use Purifier;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('id', 'desc')->get();
        return view('backend.news.index')->withNews($news);
    }

    public function create()
    {
        return view('backend.news.create');
    }

    public function createPost(Request $request)
    {
        $news = new News;
        $news->title = $request->title;
        $news->slug = $title = str_slug($news->title, '-');
        $news->content = Purifier::clean($request->news_content);
        $news->save();
        return redirect('admin/news');
    }
}
