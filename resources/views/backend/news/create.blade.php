@extends ('backend.layouts.app')

@section('page-header')
    <h1>
        News
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection
@section('content')

<div class="row">
        <!-- left column -->
        <div class="col-md-8 col-md-offset-2">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create News Article</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="new_title">Title</label>
                  <input type="text" name="title" class="form-control" id="news_title" placeholder="Enter title">
                </div>
                
                <div class="form-group">
                  <label for="new_content">Content</label>
                    <textarea  name="news_content" class="form-control" id="news_content" ></textarea>
                </div>
                  
                  
                  <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    
                  <label for="imageInputFile">Choose Image Desktop</label>
                  <input type="file" id="imageInputFile" name="attachment">

                  <p class="help-block">Main Image.</p>
                </div>
                </div>
                 
                      <div class="col-md-6">
                <div class="form-group">
                    
                  <label for="imageInputFile">Choose Image Form Server</label>
                  <input type="file" id="imageInputFile" name="attachment">

                  <p class="help-block">Main Image.</p>
                </div>
                </div>
                      
                      
                      
                      
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-success pull-right">Submit</button>
              </div>
            </form>
          </div>
@section('after-scripts')
     <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('news_content');
    </script>         
@endsection
@endsection
