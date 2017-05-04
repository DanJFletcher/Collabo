<?php

namespace App\Http\Controllers\Backend\Events;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Access\User\User;
use App\Models\Access\Team\Team;
use App\Models\Dashboard\Event;
use App\Models\Dashboard\Total;
use App\Mail\TeamEvents;

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
        if($event && $request->has('team_owner'))
        {

         $teamModel = config('teamwork.team_model');
         $team = $teamModel::findOrFail($event->team_id);
         $content = [
             'teams' => $team,
             'events' => $event,

         ];

         $emails = [];
         foreach($team->users as $users)
         {
             array_push($emails, $users->email);
         }
         $mailTo = \Auth::user()->email;
        // Version for Mail Trap
         \Mail::to($mailTo)->cc($emails)->send(new TeamEvents($content));
         /*
         *  Live
         * \Mail::to($mailTo)->bcc($emails)->send(new TeamEvents($content));
         */
         return redirect('admin/teams');


        }



          return redirect('admin/events');

    }
}
