<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Access\User\User;
use Nahid\Talk\Facades\Talk;
use Auth;
use View;

class ConversationsController extends Controller
{
    protected $authUser;

    /**
     * Conversations controller constructor.
     * @return void
     */
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
    public function show($id)
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
}
