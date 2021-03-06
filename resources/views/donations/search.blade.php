@extends('layouts.app')

@section('page_title','donations')
                 
@section('content')     
  <!-- Main content -->
  <section class="content">

      <br>
      <form action="{{ action('DonationController@search')}}" method="get" autocomplete="off" >
        <label for="s"> Search Box </label>
        <input  id="s" type="text" name="query" placeholder="Search donations .." value="{{request()->input('query')}}" class="form-control" > 
        <span class="text-danger"> {{ $errors->first('query')}}</span>

      </form>
        <br>
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
          <h1> Search results </h1>
          <p>{{$donations->count()}} result(s) found for <b>'{{ request()->input('query')}}'</b>   search</p>
          @if (count($donations))
              <table class="table table-bordered">
                <tbody>

                  <tr>
                    <th  style="width: 10px"> # </th>
                    <th  class="text-center"> Client Name</th>
                    <th  class="text-center">  Patient name</th>
                    <th  class="text-center"> Patient Age</th>
                    <th  class="text-center"> Hospital name </th>
                    <th  class="text-center"> Hospital address </th>
                    <th  class="text-center"> phone </th>
                    <th  class="text-center"> Number of bags</th>
                    <th  class="text-center"> BloodType</th>
                    <th  class="text-center"> Governorate</th>
                    <th  class="text-center"> City</th>
                    <th  class="text-center"> Delete</th>
                </tr>
                  @foreach ($donations as $donation)
                  <tr>
                    <td   class="text-center"> {{ $loop->iteration}} </td>
                    <td   class="text-center"> 
                       <a href="{{url(route('donation.show',$donation->id))}}"> {{$donation->client->name}} </a> 
                    </td>
                    <td   class="text-center"> {{ $donation->patient_name }}</td>                      
                    <td   class="text-center"> {{ $donation->patient_age}} </td>
                    <td   class="text-center"> {{ $donation->hospital_name}} </td>
                    <td   class="text-center"> {{ $donation->hospital_address}} </td>
                    <td   class="text-center"> {{ $donation->phone}} </td>
                    <td   class="text-center"> {{ $donation->bags_number}} </td>
                    <td   class="text-center"> {{$donation->bloodType->type}}  </td>
                    <td   class="text-center"> {{optional($donation->city->governorate)->name}}  </td>
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
  