@extends ('backend.layouts.app')
@section('after-styles')
{!! Charts::assets() !!}
@endsection
@section('page-header')
    <h1>
       Donations Reports
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection
@section('content')
<div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">All Donations</h3>

            <div class="box-tools pull-right">
             <div class = "btn-group">
               <button type = "button" class = "btn btn-default" data-toggle = "dropdown">Print</button>

               <button type = "button" class = "btn btn-default dropdown-toggle" data-toggle = "dropdown">
                  <span class = "caret"></span>
                  <span class = "sr-only">Toggle Dropdown</span>
               </button>

               <ul class = "dropdown-menu" role = "menu">
                  <li><a href = "#">XLS</a></li>
                  <li><a href = "#">XLSX</a></li>
                  <li><a href = "#">CSV</a></li>

                  <li class = "divider"></li>
                  <li><a href = "#">PDF</a></li>
               </ul>
                </div>
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->
        <br><br>

            <div class="box-body">
            <div class="table-responsive">
                <table id="users-reports" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Postal</th>
                            <th>Payment Type</th>
                            <th>Amount</th>
                            <th>Donaton Date</th>
                        </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->

    </div><!--box-->
<div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Last @if(isset($timeline)){{$timeline}} @else 14 @endif Days</h3>
            <form  action="{{URL::To('admin/reports/donations')}}" method="get">
            <div class="box-tools pull-right">
             <select class="form-control"  name="timeline" onchange="this.form.submit()">
                <option disabled >Sort</option>
                <option value="90" @if(isset($timeline)) @if($timeline == 60) Selected @endif @endif>3 Months</option>
                <option value="60" @if(isset($timeline)) @if($timeline == 60) Selected @endif @endif>2 Months</option>
                <option value="30" @if(isset($timeline)) @if($timeline == 30) Selected @endif @endif>30 Days</option>
                 <option value="15" @if(isset($timeline)) @if($timeline == 15) Selected @endif @endif>15 Days</option>
                </select>
            </div><!--box-tools pull-right-->
            </form>
        </div><!-- /.box-header -->
        <br><br>

            <div class="box-body">
             {!! $customers->render() !!}
        </div><!-- /.box-body -->

    </div><!--box-->
@endsection
@section('after-scripts')
{{ Html::script("js/backend/plugin/datatables/jquery.dataTables.min.js") }}
{{ Html::script("js/backend/plugin/datatables/dataTables.bootstrap.min.js") }}
<script>

$(function() {
        $('#users-reports').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ URL::to("admin/reports/donations-table") }}'
        });
    });



</script>

@endsection
