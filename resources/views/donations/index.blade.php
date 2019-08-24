@extends('layouts.app')

@section('page_title',__('lang.donation requests'))
                 
@section('content')     
  <!-- Main content -->
  <section class="content">
  <br>
  <form action="{{ action('DonationController@search')}}" method="get" autocomplete="off">
      <input type="text" name="query" placeholder="@lang('lang.search donations') .." value="{{request()->input('query')}}" class="form-control" > 
      <span class="text-danger"> {{ $errors->first('query')}}</span>
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
            @if (count($donations))
              <table class="table table-bordered">
                <tbody>

                  <tr>
                    <th  style="width: 10px"> # </th>
                    <th  class="text-center"> @lang('lang.Client Name')</th>
                    <th  class="text-center"> @lang('lang.patient age')</th>

                    <th  class="text-center"> @lang('lang.patient name')</th>
                    <th  class="text-center"> @lang('lang.hospital name') </th>
                    <th  class="text-center"> @lang('lang.hospital address') </th>
                    <th  class="text-center"> @lang('lang.phone') </th>
                    <th  class="text-center"> @lang('lang.number of bags')</th>
                    <th  class="text-center"> @lang('lang.blood type')</th>
                    <th  class="text-center"> @lang('lang.governorate')</th>
                    <th  class="text-center"> @lang('lang.city')</th>
                    <th  class="text-center"> </th>
                </tr>
                  @foreach ($donations as $donation)
                  <tr>
                    <td   class="text-center"> {{ $loop->iteration}} </td>
                    <td   class="text-center">  <a href="{{url(route('donation.show',$donation->id))}}"> {{ $donation->client->name}} </a> </td>
                    <td   class="text-center"> {{ $donation->patient_name }}</td>
                    <td   class="text-center"> {{ $donation->patient_age}} </td>
                    <td   class="text-center"> {{ $donation->hospital_name}} </td>
                    <td   class="text-center"> {{ $donation->hospital_address}} </td>
                    <td   class="text-center"> {{ $donation->phone}} </td>
                    <td   class="text-center"> {{ $donation->bags_number}} </td>
                    <td   class="text-center"> {{ $donation->bloodType->type}}  </td>
                    <td   class="text-center"> {{ optional($donation->city->governorate)->name}}  </td>
                    <td   class="text-center"> {{ $donation->city->name}} </td>

                    <td   class="text-center">
                       <form action="{{action('DonationController@destroy',$donation->id)}}" method="post">
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
  