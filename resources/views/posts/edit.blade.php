@extends('layouts.app')
@section('page_title',' Edit '. $post->title.' Post')
                  
@section('content')     
  <!-- Main content -->
  <section class="content">
   
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                     <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
        <div class="box-body">

          <!---------------------------- Form  ------------------------------------>
          
          <form action="{{ action('PostController@update',$post->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">        
            @method('PUT')
              <div class="form-group">
                <label for="my-input">Title</label>
                 <input id="my-input" class="form-control" type="text" name="title" value="{{$post->title}}">
                <span class=" text-danger"> {{ $errors->first('title') }}</span>
              </div>

              <div class="form-group">
                  <label for="my-image">image</label>
                  <input id="my-image" class="form-control" type="file" name="image" placeholder=" Enter post's image" value="{{$post->image}}">
                      <span class=" text-danger"> {{ $errors->first('image') }}</span>
                </div>

              <div class="form-group">
                    <label for="my-text">content</label>
                    <textarea id="my-text" class="form-control" name="content"  placeholder=" Enter post's content" cols="30" rows="10" >
                      {{ $post->content }}
                    </textarea>
                    <span class=" text-danger"> {{ $errors->first('content') }}</span>
                  </div>

                                   
              <div class="form-group">
                  <select name="category_id" class="form-control"  > Category
                      <option value="" disabled> choose a category for your post </option>
                      <option value="{{$post->category->id}}"> {{$post->category->name}}</option>

                    @foreach ($categories as $category)
                      <option value="{{$category->id}}"> {{$category->name}}</option>
                    @endforeach
                  </select>
                </div>
              <button type="submit" class="btn btn-primary" > Save </button>

            @csrf
          </form>
          <!----------------------------  End Of Form  ------------------------------------>

        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

@endsection
  