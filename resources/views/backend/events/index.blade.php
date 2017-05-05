@extends ('backend.layouts.app')

@section('page-header')
    <h1>
        Events
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-offset-2 col-sm-8">
      <ul class="event-list">
       
<!--
        <li>
          <time datetime="2014-07-20 0000">
            <span class="day">8</span>
            <span class="month">Jul</span>
            <span class="year">2014</span>
            <span class="time">12:00 AM</span>
          </time>
          <div class="info">
            <h2 class="title">One Piece Unlimited World Red</h2>
            <p class="desc">PS Vita</p>
            <ul>
              <li style="width:50%;"><a href="#website"><span class="fa fa-globe"></span> Website</a></li>
              <li style="width:50%;"><span class="fa fa-money"></span> $39.99</li>
            </ul>
          </div>
          <div class="social">
            <ul>
              <li class="facebook" style="width:33%;"><a href="#facebook"><span class="fa fa-facebook"></span></a></li>
              <li class="twitter" style="width:34%;"><a href="#twitter"><span class="fa fa-twitter"></span></a></li>
              <li class="google-plus" style="width:33%;"><a href="#google-plus"><span class="fa fa-google-plus"></span></a></li>
            </ul>
          </div>
        </li>
-->

      @foreach($events as $event)
            <?php
            $date_of_event = $event->date_of_event;
            $event_day = explode(' ',trim($date_of_event));
            $event_month = $event_day[0];
            $event_date = $event_day[1];
            ?>
        <li>
          <time datetime="2017-07-31 1600">
            <span class="day">{{$event_date}}</span>
            <span class="month">{{$event_month }}</span>
<!--
            <span class="year">2014</span>
            <span class="time">4:00 PM</span>
-->
          </time>

          <div class="info">
            <h2 class="title">{{$event->title}}</h2>
              <div>{!!$event->description!!}</div>

            <ul>
              <li style="width:23%;"><span class="fa fa-money"></span> $ {{(float)$event->goal_amount}} </li>
                <li><div class="progress">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="70"
                aria-valuemin="0" aria-valuemax="100" style="width:10%">
               <span class="sr-only">70% Complete</span>
                </div>
                    </div></li>
                <li style="width:24%;" id="clockdiv-{{$event->id}}" class="mystyle"><span class="days"></span> <span class="hours"></span> <span class="minutes"></span> <span class="seconds"></span></li>

            </ul>
          </div>
          <div class="social">
            <ul>
              <li class="facebook" style="width:33%;"><a href="#facebook">View</a></li>
              <li class="twitter" style="width:34%;"><a href="#twitter">Edit</a></li>
              <li class="google-plus" style="width:33%;"><a href="#google-plus">Delete</a></li>
            </ul>
          </div>
        </li>





          @endforeach
      </ul>
    </div>
  </div>
</div>





@section('after-scripts')

   <script>
  // Loop Through date and Match Id
  @foreach ($events as $event)

      initializeClock('clockdiv-{{$event->id}}', '{{ $event->date_of_event }}');

   @endforeach
</script>
<script>





    
    
//var deadline = new Date(Date.parse(new Date()) + 15 * 24 * 60 * 60 * 1000);



</script>



@endsection

@endsection
