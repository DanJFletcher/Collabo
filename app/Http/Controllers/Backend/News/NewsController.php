<?php

namespace App\Http\Controllers\Backend\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        return view('backend.news.index');
    }
    
    public function create()
    {
        return view('backend.news.create');
    }
}
