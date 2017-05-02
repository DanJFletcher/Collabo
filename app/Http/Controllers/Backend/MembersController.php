<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Access\User\ManageUserRequest;
use App\Models\Access\User\User;

class MembersController extends Controller
{
    public function index(ManageUserRequest $request)
    {
        
        $users = User::whereStatus(1)->whereConfirmed(1)->where('id','!=',1)->get();
       
        return view('backend.access.members',compact('users'));
    }

}
