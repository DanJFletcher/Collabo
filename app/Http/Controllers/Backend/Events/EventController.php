<?php

namespace App\Http\Controllers\Backend\Events;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Access\User\User;
use App\Models\Access\Team\Team;
use App\Models\Dashboard\Event;
use App\Models\Dashboard\Total;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('id','desc')->get();
        return view('backend.events.index',compact('events'));
    }
    
    public function create()
    {
        $users = User::whereStatus(1)->whereConfirmed(1)->get();
        $teams = Team::all();
        return view('backend.events.create',compact('users','teams'));
    }

    public function createPost(Request $request)
    {
        $event = new Event();
        $event->title = $request->title;
        $event->slug  = str_slug($request->title, '-');
        $event->description = $request->event_content;
        $event->goal_amount = $request->goal;
        $event->user_id = $request->user_id;
        $event->team_id = $request->team_id;
        $event->date_of_event = $request->event_date;
        $event->save();

        if($event)
        {
           $event_total = new Total;
           $event_total->event_id = $event->id;
           $event_total->team_id = $event->team_id;
           $event_total->save();

        }
          return redirect('admin/events');

    }
}
