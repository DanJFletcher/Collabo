<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Access\User\User;
use Nahid\Talk\Facades\Talk;
use Auth;
use View;

class MessagesController extends Controller
{

    protected $authUser;
    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            Talk::setAuthUserId(Auth::user()->id);
            return $next($request);
        });

        View::composer('backend.includes.partials.peoplelist', function ($view) {
            $threads = Talk::threads();
            $view->with(compact('threads'));
        });
    }

    public function index()
    {
        $users = User::all();
        return view('backend.messages.index', compact('users'));
    }

    public function chatHistory($id)
    {
        $conversations = Talk::getMessagesByUserId($id);
        $user = '';
        $messages = [];
        if (!$conversations) {
            $user = User::find($id);
        } else {
            $user = $conversations->withUser;
            $messages = $conversations->messages;
        }

        return view('backend.messages.conversations', compact('messages', 'user'));
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $rules = [
                'message-data'=>'required',
                '_id'=>'required'
            ];

            $this->validate($request, $rules);

            $body = $request->input('message-data');
            $userId = $request->input('_id');

            if ($message = Talk::sendMessageByUserId($userId, $body)) {
                $html = view('backend.messages.newMessageHtml', compact('message'))->render();
                return response()->json(['status'=>'success', 'html'=>$html], 200);
            }
        }
    }

    public function delete(Request $request, $id)
    {
        if ($request->ajax()) {
            if (Talk::deleteMessage($id)) {
                return response()->json(['status'=>'success'], 200);
            }

            return response()->json(['status'=>'errors', 'msg'=>'something went wrong'], 401);
        }
    }
}
