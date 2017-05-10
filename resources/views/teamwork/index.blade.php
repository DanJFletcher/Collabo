@extends('backend.layouts.app')

@section('page-header')
    <h1>
        Teams
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection

@section('content')
 @if ($message = Session::get('error'))
                <div class="custom-alerts alert alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {!! $message !!}
                </div>
                <?php Session::forget('error');?>
                @endif
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        Your Teams
                        <a class="pull-right btn btn-default btn-sm" href="{{route('teams.create')}}">
                            <i class="fa fa-plus"></i> Create team
                        </a>
                    </div>
                  <p>Current Team Members: @if(Auth::user()->currentTeam)({{Auth::user()->currentTeam->users->count()}})@endif</p>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teams as $team)

                                    <tr>
                                        <td>{{$team->name}}</td>
                                        <td>
                                            @if(auth()->user()->isOwnerOfTeam($team))
                                                <span class="label label-success">Owner</span>
                                            @else
                                                <span class="label label-primary">Member</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(is_null(auth()->user()->currentTeam) || auth()->user()->currentTeam->getKey() !== $team->getKey())
                                                <a href="{{route('teams.switch', $team)}}" class="btn btn-sm btn-default">
                                                    <i class="fa fa-sign-in"></i> Switch
                                                </a>
                                            @else
                                                <span class="label label-default">Current team</span>
                                            @endif

                                            <a href="{{route('teams.members.show', $team)}}" class="btn btn-sm btn-default">
                                                <i class="fa fa-users"></i> Members
                                            </a>

                                            @if(auth()->user()->isOwnerOfTeam($team))

                                                <a href="{{route('teams.edit', $team)}}" class="btn btn-sm btn-default">
                                                    <i class="fa fa-pencil"></i> Edit
                                                </a>
                                                <a href="{{route('teams.create.event',$team->id)}}" class="btn btn-sm btn-default">
                                                    <i class="fa fa-plus"></i> Event
                                                </a>


                                                <form style="display: inline-block;" action="{{route('teams.destroy', $team)}}" method="post">
                                                    {!! csrf_field() !!}
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Delete</button>
                                                </form>
                                            @else
                                            <?php
                                            $user = Auth::user()->id;
                                            ?>
                                            <form style="display: inline-block;" action="{{route('teams.members.leave', [$team, $user])}} "  id="leave" method="post">
                                                    {!! csrf_field() !!}
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <button class="btn btn-warning btn-sm leave-team"   ><i class="fa fa-sign-out" ></i> Leave</button>
                                                </form>

                                            @endif
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            
            
               <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        Teams List
                        
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Owner</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all as $teams)
                                <?php
                                $team_id = $teams->id;
                                $user = auth()->user()->name;
                                ?>
                                    <tr>
                                        <td>{{$teams->name}}</td>
                                        <td>{{$teams->owner->name}}</td>
                                        <td>
                                     <!-- Issue Here  -->

                                            {{-- Can't be use

                                            @if(Auth::user()->currentTeam->id == $team_id )--}}


                                            @if(auth()->user()->isOwnerOfTeam($team_id))

                                            <span class="label label-success">Owner</span>

                                            @else
                                               <a onclick="join({{$teams->id}})"  class="btn btn-sm btn-default">
                                                <i class="fa fa-sign-in"></i> Join
                                            </a>
                                            @endif

                                            <!--End Issue  -->

                                            {{--@if(!auth()->user()->isOwnerOfTeam($team_id) )
                                           <a onclick="join({{$teams->id}})"  class="btn btn-sm btn-default">
                                                <i class="fa fa-sign-in"></i> Join
                                            </a>


                                            @else
                                            <span class="label label-success">Owner</span>



                                            @endif--}}
<!--
                                             @if(Auth::user()->teams )
                                            @else
                                            <span class="label label-primary">Member</span>
                                            @endif


-->
<!--
                                            <a href="{{route('teams.view',$teams->id)}}" class="btn btn-sm btn-default">
                                                <i class="fa fa-sign-in"></i> Join
                                            </a> 
-->
                                        </td>
                                        <td>
 
                                        </td>
                                    </tr>
                                @endforeach
{{--{{Auth::user()->teams}}--}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<input type="hidden" name="join-team" id="join-team" value="{{route('teams.join')}}">

@section('after-scripts')

<script>
// Join Team
    function join(id)
      {

         swal({
          title: "Are you sure?",
          text: "Are you sure you want join this team?",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, Join!",
          cancelButtonText: "No, cancel please!",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm) {
             if (isConfirm) {
          var join_team = $("#join-team").val(),
              delay = 1000;

          $.ajax({
            url: join_team ,
            type:"POST",
            data: {"id":id,_token: "{{ csrf_token() }}"},
            success: function(approve_job){
              swal("Success!", "You are now part of this team", "success");
              setTimeout(function(){ location.reload(); }, delay);
            },
              error: function(msg) {
                swal("Oops...", "Something went wrong!", "error");
              }
          });
          }
           else {
           swal("Cancelled", "You will not be added to this members list", "error");
          }
          });

      }



   $(function() {
   $(".leave-team").click(function(e){
       e.preventDefault();
       swal({
          title: "Are you sure?",
          text: "Are you sure you want leave this team?",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, Leave!",
          cancelButtonText: "No, cancel please!",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm) {
             var delay = 1000;
             if (isConfirm) {
             $('form#leave').submit();
             swal("Success!", "You are no longer a part of this team!", "success");
//             setTimeout(function(){ $('form.leave-team-member').submit(); }, delay);
             }
           else {
           swal("Cancelled", "You will not be remove this team", "error");
          }
          });

   });
});



</script>
@endsection
@endsection
