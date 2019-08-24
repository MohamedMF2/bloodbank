@extends('layouts.app')

@section('page_title',__('lang.categories'))
                 
@section('content')     
  <!-- Main content -->
  <section class="content">
   
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <a href="{{url(route('category.create'))}}">
                <button class="btn btn-primary"> <i class="fa fa-plus"></i>{{__('lang.new category')}} </button>
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
            @if (count($categories))
              <table class="table table-bordered">
                <tbody>

                  <tr>
                    <th style="width: 10px">#</th>
                    <th  class="text-center"> @lang('lang.category name') </th>
                    <th class="text-center"> @lang('lang.edit')</th>
                    <th class="text-center"> @lang('lang.delete')</th>

                  </tr>
                  @foreach ($categories as $category)
                      <tr>
                         <td> {{ $loop->iteration}} </td>
                      <td  class="text-center">  <a href="{{ url(route('category.show',$category->id)) }}">{{ $category->name }} </a></td>
                         <td  class="text-center"> 
                           <a href="{{ url(route('category.edit',$category->id)) }}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> </a>
                         </td>
                         <td  class="text-center">
                            <form action="{{action('CategoryController@destroy',$category->id)}}" method="post">
                              @method('DELETE')
                              @csrf
                              <button type="submit" class="btn btn-sm btn-danger"><i class=" fa fa-trash-o"></i></button>
                            </form>
                          </td>

                        </tr>
                  @endforeach
                 
                </tbody>
              </table>    

            @else
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">nodata</h4>
                </div>
            @endif
        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

@endsection
  