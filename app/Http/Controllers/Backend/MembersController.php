<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Access\User\ManageUserRequest;
use App\Models\Access\User\User;
use App\Mail\EmailUsers;

class MembersController extends Controller
{
    public function index(Request $request)
    {
        
        $users = User::whereStatus(1)->whereConfirmed(1)->where('id','!=',1)->where('id', '!=', \Auth::user()->id)->get();

        return view('backend.members.index',compact('users'));
    }

    public function show(Request $request)
    {

          if($request->ajax()){
                $id = $request->id;
                $users = User::find($id);
                return response()->json($users);
            }
    }

    public function mailUser(Request $request)
    {
        $id = $request->user_id;
        $user = User::find($id);
        $email = $user->email;
        $data = [
          'user' => $user,
          'subject' => $request->subject,
          'content' => $request->email_content,
        ];

         \Mail::to($email)->send(new EmailUsers($data));
        return back();
    }
}
