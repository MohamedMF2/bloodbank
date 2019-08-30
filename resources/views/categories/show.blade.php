@extends('layouts.app')


@section('page_title', $category->name )
                 
@section('content')     
  <!-- Main content -->
  <section class="content">
   
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            
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
            @if ($posts)
              <table class="table table-bordered">
                <tbody>

                  <tr>
                      <th>#</th>
                    <th  class="text-center">  @lang('lang.title')</th>
                    <th  class="text-center">@lang('lang.content') </th>
                    <th  class="text-center">@lang('lang.edit')</th>
                    <th  class="text-center">@lang('lang.delete')</th>

                  </tr>
                    @foreach ($posts as $post)
                        
                      <tr>
                         <td>{{ $loop->iteration}}</td>
                         <td  class="text-center"> {{ $post->title}}  </td>
                         <td  class="text-center"> {{ str_limit( $post->content,60)}}  </td>
                         <td  class="text-center"> 
                            <a href="{{ url(route('post.edit',$post->id)) }}" class="btn btn-lg btn-success"><i class="fa fa-edit"></i> </a>
                         </td>
                         <td  class="text-center">
                            <form action="{{action('CategoryController@destroy',$category->id)}}" method="post">
                              @method('DELETE')
                              @csrf
                              <button type="submit" class="btn btn-lg btn-danger"><i class=" fa fa-trash-o"></i></button>
                            </form>
                          </td>

                        </tr>
                    @endforeach

                </tbody>
              </table>    

            @else
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">@lang('lang.nodata')</h4>
                </div>
            @endif
        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

@endsection
  