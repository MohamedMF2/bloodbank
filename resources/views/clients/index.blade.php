@extends('layouts.app')

@section('page_title',__('lang.Clients'))
                 
@section('content')     
  <!-- Main content -->
  <section class="content">
  <br>
  <form action="{{ action('ClientController@index')}}" method="get" autocomplete="off">
      <input type="text" name="search" placeholder="@lang('lang.Search clients by thier name ,phone ,bloodtype and city').." value="{{request()->input('search')}}" class="form-control" > 
      <span class="text-danger"> {{ $errors->first('search')}}</span>
  </form>
  <br>
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
            @if (count($clients))
              <table class="table table-bordered">
                <tbody>

                  <tr>
                    <th style="width: 10px">#</th>
                    <th  class="text-center"> @lang('lang.Client Name')</th>
                    <th  class="text-center">  @lang('lang.Last Donation Date') </th>
                    <th  class="text-center">  @lang('lang.Blood Type') </th>
                    <th  class="text-center"> @lang('lang.governorate')  </th>
                    <th  class="text-center"> @lang('lang.status')  </th>
                    <th class="text-center">  @lang('lang.Change status')</th>
                    <th class="text-center"> @lang('lang.delete')</th>


                  </tr>
                  @foreach ($clients as $client)
                      <tr>
                         <td> {{ $loop->iteration}} </td>
                         <td  class="text-center">  <a href="{{url(route('client.show',$client->id))}}"> {{ $client->name }}</a> </td>
                           
                         <td  class="text-center"> {{ $client->date_of_last_donation}} </td>
                         <td  class="text-center"> {{$client->bloodType->type}}  </td>

                         <th  class="text-center"> {{optional($client->city->governorate)->name}}  </th>

                        
                         <td  class="text-center"> {{ $client->activated ?"Active":"Deactivated"}} </td>

                         <td class="text-center">
                            @if($client->activated)
                         <a href="{{url(route('client.deActive',$client->id))}}" class="btn btn-xs btn-danger"><i class="fa fa-close"></i> إيقاف</a>
                            @else
                                <a href="{{url(route('client.active',$client->id))}}" class="btn btn-xs btn-success"><i class="fa fa-check"></i> تفعيل</a>
                            @endif
                         </td>
                         <td  class="text-center">
                            <form action="{{action('ClientController@destroy',$client->id)}}" method="post">
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
  