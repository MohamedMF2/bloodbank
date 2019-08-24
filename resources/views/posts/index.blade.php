@extends('layouts.app')

@section('page_title',__('lang.posts'))
                 
@section('content')     
  <!-- Main content -->
  <section class="content">
   <form action="{{ action('PostController@index')}}" method="get" autocomplete="off">
     <div class="form-group">
        <input type="search" name="search" placeholder="@lang('lang.Search Posts by Title , Content or Category').." value="{{request()->input('search')}}" class="form-control" > 
        <span class="text-danger"> {{ $errors->first('search')}}</span>

     </div>
     @csrf
   </form>
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <a href="{{url(route('post.create'))}}">
                <button class="btn btn-primary"> <i class="fa fa-plus"></i>@lang('lang.new post') </button>
              </a>  <br><br>
              @include('flash::message')
            

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
            @if (count($posts))
              <table class="table table-bordered">
                <tbody>

                  <tr>
                    <th style="width: 10px">#</th>
                    <th  class="text-center">@lang('lang.post title') </th>
                    <th class="text-center">@lang('lang.edit')</th>
                    <th class="text-center">@lang('lang.delete')</th>
                  </tr>

                  @foreach ($posts as $post)
                      <tr>
                         <td  class="text-center"> {{ $loop->iteration}} </td>
                         <td  class="text-center"> <a href="{{url(route('post.show',$post->id))}}"> {{ $post->title }} </a>  </td>

                         <td  class="text-center"> 
                           <a href="{{ url(route('post.edit',$post->id)) }}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> </a>
                         </td>
                         <td  class="text-center">
                            <form action="{{action('PostController@destroy',$post->id)}}" method="post">
                              @method('DELETE')
                              @csrf
                              <button type="submit" class="btn btn-sm btn-danger delete" onclick="confirm()" ><i class=" fa fa-trash-o"></i></button>
                            
                            </form>
                            
                          </td>
                        </tr>
                  @endforeach
                 
                </tbody>
              </table>    

            @else
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">@lang('lang.no data')</h4>
                </div>
            @endif
        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

@endsection
 