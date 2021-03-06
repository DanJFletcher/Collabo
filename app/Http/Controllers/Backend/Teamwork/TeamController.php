<?php

namespace App\Http\Controllers\Backend\Teamwork;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Mpociot\Teamwork\Exceptions\UserNotInTeamException;
use App\Models\Access\User\User;
use App\Models\Dashboard\Event;
use App\Models\Dashboard\TeamTotal;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $teamModel = config('teamwork.team_model');
        $all = $teamModel::all();
        return view('teamwork.index')
            ->with('teams', auth()->user()->teams)->withAll($all);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teamwork.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $teamModel = config('teamwork.team_model');

        $team = $teamModel::create([
            'name' => $request->name,
            'owner_id' => $request->user()->getKey()
        ]);

        if ($team) {
            $team_total = new TeamTotal;
            $team_total->event_id = null;
            $team_total->team_id = $team->id;
            $team_total->save();
        }

        $request->user()->attachTeam($team);

        return redirect(route('admin.teams.index'));
    }

    /**
     * Switch to the given team.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function switchTeam($id)
    {
        $teamModel = config('teamwork.team_model');
        $team = $teamModel::findOrFail($id);
        /*Added*/
        $userModel = config('teamwork.user_model');
        $current_event_id = Event::where('team_id', $id)->first();
        try {
            auth()->user()->switchTeam($team);
            /**
            * Update current event id when user switch teams
            * Only run code if an event_id is present
            **/
            if (!empty($current_event_id)) {
                $userModel::where('current_team_id', $id)
                    ->update(['current_event_id' => $current_event_id->id]);
            } else {
                $userModel::where('current_team_id', $id)
                    ->update(['current_event_id' => null]);
            }
        /*End*/
        } catch (UserNotInTeamException $e) {
            abort(403);
        }

        return redirect(route('admin.teams.index'));
    }

    public function seeTeam($id)
    {
        $teamModel = config('teamwork.team_model');
        $team = $teamModel::findOrFail($id);


        return view('teamwork.show')->withTeam($team);
    }

    public function joinTeam(Request $request)
    {
        $id = $request->id;
        $user = User::whereId(\Auth::user()->id)->first();
        $user->teams()->attach($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teamModel = config('teamwork.team_model');
        $team = $teamModel::findOrFail($id);

        if (!auth()->user()->isOwnerOfTeam($team)) {
            abort(403);
        }

        return view('teamwork.edit')->withTeam($team);
    }

    public function event($id)
    {
        $teamModel = config('teamwork.team_model');
        $team = $teamModel::findOrFail($id);
        $existing_event = Event::where('team_id', $id)->first();
        if (!auth()->user()->isOwnerOfTeam($team)) {
            abort(403);
        }
        if ($existing_event) {
            \Session::put('error', 'Event already exist for this team.');
            return back();
        }

        return view('teamwork.create-event')->withTeam($team);
    }

//     $existing_event = $event::where('team_id', $id->exists());
//        if($existing_event){
//          abort(403);
//        }
//        else{
//         return view('teamwork.create-event')->withTeam($team);
//        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $teamModel = config('teamwork.team_model');

        $team = $teamModel::findOrFail($id);
        $team->name = $request->name;
        $team->save();

        return redirect(route('admin.teams.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teamModel = config('teamwork.team_model');

        $team = $teamModel::findOrFail($id);
        if (!auth()->user()->isOwnerOfTeam($team)) {
            abort(403);
        }

        $team->delete();

        $userModel = config('teamwork.user_model');
        $userModel::where('current_team_id', $id)
                    ->update(['current_team_id' => null]);

        return redirect(route('admin.teams.index'));
    }
}
