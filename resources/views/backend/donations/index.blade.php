@extends ('backend.layouts.app')
@section('after-styles')
<style>
input.parsley-success,
select.parsley-success,
textarea.parsley-success {
  color: #468847;
  background-color: #DFF0D8;
  border: 1px solid #D6E9C6;
}

input.parsley-error,
select.parsley-error,
textarea.parsley-error {
  color: #B94A48;
  background-color: #F2DEDE;
  border: 1px solid #EED3D7;
}

.parsley-errors-list {
  margin: 2px 0 3px;
  padding: 0;
  list-style-type: none;
  font-size: 0.9em;
  line-height: 0.9em;
  opacity: 0;

  transition: all .3s ease-in;
  -o-transition: all .3s ease-in;
  -moz-transition: all .3s ease-in;
  -webkit-transition: all .3s ease-in;
}

.parsley-errors-list.filled {
  opacity: 1;
}





</style>

@endsection
@section('page-header')
    <h1>
        Donations
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection
@section('content')

@if ($message = Session::get('success'))
<div class="custom-alerts alert alert-success fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        {!! $message !!}
    </div>
<?php Session::forget('success');?>
@endif

 @if ($message = Session::get('error'))
    <div class="custom-alerts alert alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        {!! $message !!}
    </div>
    <?php Session::forget('error');?>
@endif
<!-- <button onclick="showDonation()" class="btn btn-success">Add Donation</button><br><br>-->
<button class="btn btn-success add-donor" id="add-donation" data-toggle="collapse" data-target="#donation-form">Add Donation</button>
<button class="btn btn-success" id="add-paypal" data-toggle="collapse" data-target="#paypal-form">Paypal</button><br><br>



 <div class="box box-success collapse"  id="donation-form">
        <div class="box-header with-border">
            <h3 class="box-title">Donation Form</h3>
<!--
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
-->
        </div><!-- /.box-header -->
        <div class="box-body">





            <!-- CREDIT CARD FORM STARTS HERE -->
<div class="panel panel-default credit-card-box">
    <div class="panel-heading display-table">
        <div class="row display-tr">
            <h2 class="panel-title display-td">@if(Auth::user()->currentTeam)You are donating to  {{ ucwords(Auth::user()->currentTeam->name)}}@else Please Choose A Team to add Donation to @endif</h2>
            <div class="display-td">
                <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
            </div>
        </div>
    </div>
    <div class="panel-body">
        {{ Form::open(['route' => 'admin.donations.collect','data-parsley-validate' => '', 'id' => 'payment-form', 'role' => 'form', 'method' => 'post']) }}

             <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Full Name" autocomplete="name" data-parsley-minlength="3" data-parsley-required-message="Name is required" data-parsley-trigger="change focusout" data-parsley-maxlength="65" required/>

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 pull-right">
                <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="email"  />
                    </div>

                </div>
            </div>


              <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" placeholder="Phone" autocomplete="phone"  autofocus />

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 pull-right">
                <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" placeholder="Address" autocomplete="address"  />
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label for="city">City</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="city" placeholder="City" autocomplete="city"  autofocus />

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 pull-right">
                <div class="form-group">
                        <label for="postal">Postal Code</label>
                        <input type="text" class="form-control" name="postal" placeholder="postal" autocomplete="postal"  />
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label for="cardNumber">CARD NUMBER</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                            <input type="tel" class="form-control" name="cardNumber" placeholder="Valid Card Number" autocomplete="cc-number" autofocus />

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 pull-right">
                <div class="form-group">
                        <label for="cardCVC">CV CODE</label>
                        <input type="tel" class="form-control" name="cardCVC" placeholder="CVC" autocomplete="cc-csc" />
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> Year</label>
                        <select name="cardExpiryYear"  id="expiry" class="form-control"  >
                          <option value="" selected disabled>EXPIRY Year*</option>
                            @for($i = 2017; $i <= 2030; $i++)
                              <option value="{{ $i }}">{{ $i }}</option>
                           @endfor
                           </select>

                    </div>
                </div>
                <div class="col-xs-12 col-md-6 pull-right">
                   <div class="form-group">
                        <label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> Month</label>
                       <select class="form-control" name="cardExpiryMonth">
                        <option value="" selected>EXPIRY Month *</option>
                        @for ($i = 1; $i <= 12; $i++)
                        <option value="{{date( 'm', mktime( 0, 0, 0, $i + 1, 0, 0 ) )}}">{{date( 'F', mktime( 0, 0, 0, $i + 1, 0, 0 ) )}}</option>
                        @endfor
                        </select>
                    </div>
                </div>
            </div>

             <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label for="city">Amount</label>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                            <input id="donate-amount"  type="tel" class="form-control" name="amount" placeholder="Donation Amount (CAD)" autocomplete="number" autofocus />

                        </div>
                    </div>
                </div>
                 <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label for="comment">Add Message</label>
                        <input type="text" class="form-control" name="comment" placeholder="Message" >
                    </div>
                </div>

            </div>

            <div class="row">

            </div>
            <!-- Hidden Values-->
        <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
           @if(Auth::user()->currentTeam)
            <input type="hidden" value="{{Auth::user()->currentTeam->id}}" name="team_id">

            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <button class="btn btn-success btn-lg btn-block" type="submit"><i class="fa fa-lock" aria-hidden="true"></i> Donate ($<span id="donate-button"></span>)</button>
                </div>
            </div>
            @else
            <h3 class="text-center">You need to choose a team before donations can be processed</h3>
            @endif
            <div class="row" style="display:none;">
                <div class="col-xs-12">
                    <p class="payment-errors"></p>
                </div>
            </div>
        {{ Form::close()}}
    </div>
</div>

        </div><!-- /.box-body -->
    </div><!--box box-success-->

<div class="box box-success collapse"  id="paypal-form">
        <div class="box-header with-border">
            <h3 class="box-title">Donation Form</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <!-- CREDIT CARD FORM STARTS HERE -->
<div class="panel panel-default credit-card-box">
    <div class="panel-heading display-table">
        <div class="row display-tr">
            <h2 class="panel-title display-td">@if(Auth::user()->currentTeam)You are donating to  {{ ucwords(Auth::user()->currentTeam->name)}}@else Please Choose A Team to add Donation to @endif</h2>
            <div class="display-td">
                <img class="img-responsive pull-right" src="">
            </div>
        </div>
    </div>
    <div class="panel-body">
        {{ Form::open(['route' => 'admin.paypal.collect','data-parsley-validate' => '', 'id' => 'payment-form', 'role' => 'form', 'method' => 'post']) }}

             <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label for="city">Amount</label>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                            <input id="paypal-amount"  type="tel" class="form-control" name="amount" placeholder="Donation Amount (CAD)" autocomplete="number" autofocus />

                        </div>
                    </div>
                </div>
                 <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label for="comment">Add Message</label>
                        <input type="text" class="form-control" name="comment" placeholder="Message" >
                    </div>
                </div>

            </div>

            <div class="row">

            </div>
            <!-- Hidden Values-->
        <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
           @if(Auth::user()->currentTeam)
            <input type="hidden" value="{{Auth::user()->currentTeam->id}}" name="team_id">
            <input type="hidden" value="{{Auth::user()->current_event_id}}" name="event_id">

            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <button class="btn btn-success btn-lg btn-block" type="submit"><i class="fa fa-lock" aria-hidden="true"></i> Donate ($<span id="paypal-button"></span>)</button>
                </div>
            </div>
            @else
            <h3 class="text-center">You need to choose a team before donations can be processed</h3>
            @endif
            <div class="row" style="display:none;">
                <div class="col-xs-12">
                    <p class="payment-errors"></p>
                </div>
            </div>
        {{ Form::close()}}
    </div>
</div>

        </div><!-- /.box-body -->
    </div><!--box box-success-->


    <div class="box box-info  ">
        <div class="box-header with-border">
            <h3 class="box-title">Recent User Donations</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body ">
          <div class="list-group">
    @foreach($customers as $customer)
   <a href="#" class="list-group-item">
    <h4 class="list-group-item-heading">${{$customer->amount}} Donation </h4>
       <p class="list-group-item-text">From {{$customer->name}} on <small>{{ date('F dS, Y', strtotime($customer->created_at)) }} </small> </p>
  </a>
 @endforeach

</div>
        </div><!-- /.box-body -->
        <div class="text-center">{{ $customers->links() }}  </div>
    </div><!--box box-success-->

<div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Recent Team Donations </h3>
            <span class="pull-right"> Page:{{ $team_donations->currentPage()}} of {{$team_donations->lastPage() }}</span>
        </div><!-- /.box-header -->

        <div class="box-body">
        @if(!empty($team_donations))
        @if(count($team_donations) > 0)
        @foreach($team_donations as $donation)
             <a href="#" class="list-group-item">
    <h4 class="list-group-item-heading">${{$donation->amount}} Donation </h4>
       <p class="list-group-item-text">From {{$donation->name}} on <small>{{ date('F dS, Y', strtotime($donation->created_at)) }} </small> </p>
  </a>
            @endforeach

            @else
           <p>No donation collected for this team as yet.</p>
         @endif

        </div><!-- /.box-body -->
    <div class="text-center">{{ $team_donations->links() }}  </div>
    </div><!--box-->


@endif
@endsection
@section('after-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js"></script>
<script>
function showDonation() {
    var donationForm = document.getElementById('myTest');
    if (donationForm.style.display === 'none') {
        donationForm.style.display = 'block';
    } else {
        donationForm.style.display = 'none';
    }
}


    $(document).ready(function(){
        $("#donate-amount").on("change keypress input", function() {
            $("#donate-button").text( $("#donate-amount").val() );
        });
    });
    $(document).ready(function(){
    $("#paypal-amount").on("change keypress input", function() {
        $("#paypal-button").text( $("#paypal-amount").val() );
    });
});
    
    
    $('button#add-donation').click(function(){ //you can give id or class name here for $('button')
    $(this).text(function(i,old){
        return old=='Add Donation' ?  'Close Stripe Form' : 'Add Donation';
    });
    $(this).toggleClass("btn-danger");
});

    $('button#add-paypal').click(function(){ //you can give id or class name here for $('button')
    $(this).text(function(i,old){
        return old=='Paypal' ?  'Close Paypal Form' : 'Paypal';
    });
    $(this).toggleClass("btn-danger");
});

//    $(function () {
//  $('#payment-form').parsley().on('field:validated', function() {
//    var ok = $('.parsley-error').length === 0;
//    $('.bs-callout-info').toggleClass('hidden', !ok);
//    $('.bs-callout-warning').toggleClass('hidden', ok);
//  })
//  .on('form:submit', function() {
//    return false; // Don't submit form for this demo
//  });
//});

</script>
@endsection
