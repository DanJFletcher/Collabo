@extends ('backend.layouts.app')
@section('after-styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css">


@endsection
@section('before-styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
@endsection

@section('page-header')
    <h1>
        Events
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection
@section('content')


        <!-- left column -->
        <div class="col-md-8 col-md-offset-2">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create New Event</h3>
            </div>


                {{ Form::open(['route' => 'admin.events.create_post']) }}
              <div class="box-body">
                <div class="form-group">
                  <label for="new_title">Title</label>
                  <input type="text" name="title" class="form-control" id="news_title" placeholder="Enter title">
                </div>

                   <div class="form-group">
                  <label for="goal">Funding Goal For This Event</label>
                  <input type="text" name="goal" class="form-control" id="goal" placeholder="$ Amount">
                </div>

                <div class="form-group">
                  <label for="event_content">Description</label>
                    <textarea  name="event_content" class="form-control" id="event_content" ></textarea>
                </div>
                  <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>

                  <input name="event_date" type="text" class="form-control pull-right" id="datepicker" placeholder="Date of Event">
                </div>

              </div>
              <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
              <input type="hidden" name="team_id" value="{{$team->id}}">
              <input type="hidden" name="team_owner" value="owner">
              <!-- /.box-body -->


              <div class="box-footer">
                <button type="submit" class="btn btn-success pull-right">Submit</button>
              </div>

               {{ Form::close() }}
<!--            </form>-->


          </div>


 @section('after-scripts')
     <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>

        CKEDITOR.replace( 'event_content', {
        toolbar : [
          { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
    			{ name: 'basicstyles', items : [ 'Bold','Italic' ] },
    			{ name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
          { name: 'clipboard', items : [ 'PasteText','PasteFromWord','-','Undo','Redo' ] },
	        { name: 'tools', items : [ 'Maximize','-'] },
        ]
      });

         //Date picker
//    $('#datepicker').datepicker({
//      autoclose: true
//    });
        $(".select2").select2();
        /* Date Picker */

      var date = new Date();
      date.setDate(date.getDate()-1);
      $('#datepicker').datepicker({
        format: 'MM d yyyy',
        startDate: date,
        todayHighlight: true,
        clearBtn: true,
        autoclose: true,
      });
    </script>
@endsection


@endsection
