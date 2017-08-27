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
                            <th>Current Team</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    @foreach($users as $user)
                    <tr>
                    <td>{{$user->name}}</td>


                    <td>
                       @if(count($user->teams) > 0)
                       @foreach($user->teams as $team)
                        {{$team->name}}
                        @endforeach
                        @endif
                    </td>

                    <td>
                       <button onclick="email_user('{{$user->id}}')" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-xs"><i class="fa fa-envelope " aria-hidden="true"></i></button>
                        <a href="{{route('admin.messages.read', ['id'=>$user->id])}}" class="btn btn-info btn-xs"><i class="fa fa-comments-o" aria-hidden="true"></i></a>


                        </td>
                    </tr>
                    @endforeach
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        {{ Form::open(['route' => 'admin.members.email-user', 'id' => 'email-users']) }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Email <span id="email_name"></span></h4>
      </div>

      <div class="modal-body">
        <div class="form-group">
<!--                  <label for="new_title">Title</label>-->
                  <input type="Subject" name="subject" class="form-control" id="email_subject" placeholder="Subject:">
                </div>
          <div class="form-group">
                    <textarea  name="email_content" class="form-control" id="email_content" ></textarea>
                </div>


          <input id="email_id" type="hidden" name="user_id">


      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send</button>
      </div>

               {{ Form::close() }}
    </div>
  </div>
</div>
<input type="hidden" name="hidden_view" id="hidden_view" value="{{route('admin.members.show')}}" >
@endsection

@section('after-scripts')

 <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>

         CKEDITOR.replace( 'email_content', {
        toolbar : [
          { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
    			{ name: 'basicstyles', items : [ 'Bold','Italic' ] },
    			{ name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
          { name: 'clipboard', items : [ 'PasteText','PasteFromWord','-','Undo','Redo' ] },
	        { name: 'tools', items : [ 'Maximize','-'] },
        ]
      });



      function email_user(id)
    {
      var view_url = $("#hidden_view").val();
        $.ajax({
          url: view_url,
          type:"GET",
          data: {"id":id},
          success: function(result){

          $("#email_id").val(result.id);
          $("#email_name").text(result.name);
        }
      });
    }


         $('#myModal').on('hidden.bs.modal', function () {
     $('#email-users input ').each(function() {
      $(this).val('');
	 });
     $('#email-users textarea').each(function() {
      $(this).val('');
	 });
})


    </script>

@endsection
