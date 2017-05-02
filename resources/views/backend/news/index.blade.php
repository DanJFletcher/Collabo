@extends ('backend.layouts.app')

@section('page-header')
    <h1>
        News
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection
@section('content')
<div class="col-md-10 blogShort">
                     <h1>Title 1</h1>
                     <img src="http://placehold.it/150x150" alt="post img" class="pull-left img-responsive thumb margin10 img-thumbnail">
                     
                         <em>Posted <i class="fa fa-clock-o" aria-hidden="true"></i> 3 hrs ago <a href="#" ></a></em>
                     <article><p>
                         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                         ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only 
                         five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release
                         of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of
                         Lorem Ipsum.    
                         </p></article>
                     <a class="btn btn-blog pull-right marginBottom10" href="http://bootsnipp.com/user/snippets/2RoQ">READ MORE</a> 
                 </div>
              
                 
                  

@endsection