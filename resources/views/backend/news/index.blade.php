@extends ('backend.layouts.app')

@section('page-header')
    <h1>
        News
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection
@section('content')

@foreach($news as $news)
<div class="col-md-8 col-md-offset-2 ">
                     <h1>{{$news->title}}</h1>
                     <img src="http://placehold.it/150x150" alt="post img" class="pull-left img-responsive thumb margin10 img-thumbnail">
                     
                         <em>Posted <i class="fa fa-clock-o" aria-hidden="true"></i> {{$news->created_at->diffForHumans()}} <a href="#" ></a></em>
                     <article><p>
                         {!! $news->content !!}
                         </p></article>
                     <a class="btn btn-primary pull-right marginBottom10" href="">READ MORE</a>
                 </div>
              @endforeach
@endsection

