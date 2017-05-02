<?php

namespace App\Http\Controllers\Backend\Events;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index()
    {
        return view('backend.events.index');
    }
    
    public function create()
    {
        return view('backend.events.create');
    }
}
