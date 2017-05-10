@extends ('backend.layouts.app')
@section('after-styles')
{!! Charts::assets() !!}
@endsection
@section('page-header')
    <h1>
       Team Reports
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection
@section('content')

@endsection
