@extends('backend.layouts.app')

@section('page-header')
    <h1>
        {{ app_name() }}
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection

@section('content')

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('strings.backend.dashboard.welcome') }} {{ $logged_in_user->name }}!</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {{--{!! trans('strings.backend.welcome') !!}--}}
            <p>Here you will see the most important information</p>
            
        </div><!-- /.box-body -->
    </div><!--box box-success-->
    @role(1)
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {!! history()->render() !!}
        </div><!-- /.box-body -->
    </div><!--box box-success-->
    @endauth
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">NEWS (YOU CAN VIEW ALL THE NEWS ON YOUR PAGE)</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {{--{!! trans('strings.backend.welcome') !!}--}}
            <p>Things to keep your eyes on</p>
            
        </div><!-- /.box-body -->
    </div><!--box box-success-->

 <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">EVENTS (YOU CAN VIEW ALL THE EVENTS ON YOUR PAGE)</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {{--{!! trans('strings.backend.welcome') !!}--}}
            <p>Here you'll find all the latest events</p>
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection
