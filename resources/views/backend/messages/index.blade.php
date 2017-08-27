@extends('backend.layouts.app')

@section('page-header')
    <h1>
        Messenger
    </h1>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">All Users</div>

                <div class="panel-body">
                @foreach($users as $user)
                    <table class="table">
                        <tr>
                            <td>
                                <img src="{{$user->avatar}}">
                                {{$user->name}}
                            </td>
                            <td>
                                <a href="{{route('admin.messages.read', ['id'=>$user->id])}}" class="btn btn-success pull-right">Send Message</a>
                            </td>
                        </tr>
                    </table>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
