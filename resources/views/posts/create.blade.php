@extends('layouts.app')

@section('page_title',__('lang.add new post'))
                 
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
          <form action="{{ action('PostController@store') }}" method="post" enctype="multipart/form-data" autocomplete="off">        
              <div class="form-group">
                <label for="my-input">@lang('lang.title')</label>
              <input id="my-input" class="form-control" type="text" name="title" placeholder="@lang('lang.enter title')" value="{{old('title')}}">
                <span class=" text-danger"> {{ $errors->first('title') }}</span>
              </div>

              <div class="form-group">
                  <label for="my-text">@lang('lang.content')</label>

                  <textarea id="my-text" class="form-control" name="content"  placeholder="@lang('lang.enter content')" cols="30" rows="10" >
                    {{ old('content')}}
                  </textarea>
                  <span class=" text-danger"> {{ $errors->first('content') }}</span>
                </div>
              <div class="form-group">
                  <label for="my-image">@lang('lang.image')</label>
                  <input id="my-image" class="form-control" type="file" name="image" value="{{old('image')}}">
                      <span class=" text-danger"> {{ $errors->first('image') }}</span>
                </div>

              

              <div class="form-group">
                  <label for="my-text">@lang('lang.category')</label>

                <select name="category_id" class="form-control" >
                    <option value="" disabled> @lang('lang.choose a category for your post')</option>
                  @foreach ($categories as $category)
                    <option value="{{$category->id}}"> {{$category->name}}</option>
                  @endforeach
                </select>
              </div>
                                   
              <button type="submit" class="btn btn-primary" ><i class="fa fa-plus"></i>@lang('lang.add post')  </button>
            @csrf
          </form>
        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

@endsection
  