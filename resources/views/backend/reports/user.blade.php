@extends ('backend.layouts.app')
@section('after-styles')
{!! Charts::assets() !!}
@endsection
@section('page-header')
    <h1>
        User Reports
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection
@section('content')
<div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>

            <div class="box-tools pull-right">

            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->


            <div class="box-body">
            <div class="table-responsive">
                <table id="users-reports" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
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
            ajax: '{{ URL::to("admin/reports/user-table") }}'
        });
    });



</script>

@endsection
