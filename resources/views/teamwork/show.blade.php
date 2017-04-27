@extends('backend.layouts.app')

@section('content')


 {{ Form::open(['route' => 'teams.join', 'class' => 'form-horizontal']) }}
 <button type="submit">Join</button>

{{ Form::close() }}






@endsection
