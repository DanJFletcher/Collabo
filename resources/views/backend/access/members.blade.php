@extends ('backend.layouts.app')

@section ('title', 'Members')

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@endsection

@section('page-header')
    <h1>
        All Members
        <small>{{ trans('labels.backend.access.users.active') }}</small>
    </h1>
@endsection

@section('content')

<div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.access.users.active') }}</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="users-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Current Team</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    @foreach($users as $user)
                    <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    
                    <td>
                       @if(count($user->teams) > 0) 
                       @foreach($user->teams as $team)
                        {{$team->name}} 
                        @endforeach
                        @endif
                    </td>
                        
                    <td>
                       <a class="btn btn-primary btn-xs"><i class="fa fa-envelope " aria-hidden="true"></i></a>
                        <a href="{{route('admin.message.read', ['id'=>$user->id])}}" class="btn btn-info btn-xs"><i class="fa fa-comments-o" aria-hidden="true"></i></a> 
                        
                        
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->


@endsection

@section('after-scripts')
   

    <script>
      
    </script>

@endsection
