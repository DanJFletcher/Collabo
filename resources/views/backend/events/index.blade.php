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

        

        <li>
          <time datetime="2014-07-31 1600">
            <span class="day">31</span>
            <span class="month">Jan</span>
            <span class="year">2014</span>
            <span class="time">4:00 PM</span>
          </time>         
          <div class="info">
            <h2 class="title">Event Name</h2>
            <p class="desc"> Event Info</p>
            <ul>
              <li style="width:23%;"><span class="fa fa-money"></span> $ Goal </li>
                <li style="width:24%;" id="clockdiv"><span class="days"></span> <span class="hours"></span> <span class="minutes"></span> <span class="seconds"></span></li>
                
            </ul>
          </div>
          <div class="social">
            <ul>
              <li class="facebook" style="width:33%;"><a href="#facebook">Link</a></li>
              <li class="twitter" style="width:34%;"><a href="#twitter">Link</a></li>
              <li class="google-plus" style="width:33%;"><a href="#google-plus">Link</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>





@section('after-scripts')
<script>




function getTimeRemaining(endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor((t / 1000) % 60);
  var minutes = Math.floor((t / 1000 / 60) % 60);
  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
  var days = Math.floor(t / (1000 * 60 * 60 * 24));
  return {
    'total': t,
    'days': days,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
}

function initializeClock(id, endtime) {
  var clock = document.getElementById(id);
  var daysSpan = clock.querySelector('.days');
  var hoursSpan = clock.querySelector('.hours');
  var minutesSpan = clock.querySelector('.minutes');
  var secondsSpan = clock.querySelector('.seconds');

  function updateClock() {
    var t = getTimeRemaining(endtime);

    daysSpan.innerHTML = t.days;
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

    if (t.total <= 0) {
      clearInterval(timeinterval);
    }
  }

  updateClock();
  var timeinterval = setInterval(updateClock, 1000);
}

    
    
var deadline = new Date(Date.parse(new Date()) + 15 * 24 * 60 * 60 * 1000);
initializeClock('clockdiv', deadline);


</script>

@endsection

@endsection