@extends('layouts.app')

@section('page_title',__('lang.governorates'))
                 
@section('content')     
  <!-- Main content -->
  <section class="content">
   
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <a href="{{url(route('governorate.create'))}}">
                <button class="btn btn-primary"> <i class="fa fa-plus"></i> @lang('lang.new Governorate') </button>
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
            @if (count($governorates))
              <table class="table table-bordered">
                <tbody>

                  <tr>
                    <th style="width: 10px">#</th>
                    <th  class="text-center">  @lang('lang.Governorate Name') </th>
                    <th class="text-center">@lang('lang.edit')</th>
                    <th class="text-center">@lang('lang.delete')</th>
                    <th class="text-center">@lang('lang.cities')</th>

                  </tr>
                  @foreach ($governorates as $governorate)
                      <tr>
                         <td> {{ $loop->iteration}} </td>
                         <td  class="text-center">  {{ $governorate->name }} </td>
                         <td  class="text-center"> 
                           <a href="{{ url(route('governorate.edit',$governorate->id)) }}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> </a>
                         </td>
                         <td  class="text-center">
                            <form action="{{action('GovernorateController@destroy',$governorate->id)}}" method="post">
                              @method('DELETE')
                              @csrf
                              <button type="submit" class="btn btn-sm btn-danger"><i class=" fa fa-trash-o"></i></button>
                            </form>
                          </td>

                          <td class="text-center">
                          <a href="{{ url(route('governorate.city.index',$governorate->id))}}" class="btn btn-primary"> @lang('lang.cities')</a>
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
  