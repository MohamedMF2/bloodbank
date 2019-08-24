@extends('layouts.app')


@section('page_title', $client->name .'\'s Information')
                 
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
            @if ($client)
              <table class="table table-bordered">
                <tbody>

                  <tr>
                    <th  class="text-center"> Client Name</th>
                    <th  class="text-center"> Email</th>
                    <th  class="text-center"> Phone</th>
                    <th  class="text-center"> City</th>
                    <th  class="text-center"> Birth Date</th>
                    <th  class="text-center"> Last Donation Date </th>
                    <th  class="text-center"> Blood Type </th>
                    <th  class="text-center"> Status </th>

                  </tr>
                  
                      <tr>
                         <td  class="text-center"> {{ $client->name}}  </td>
                         <td  class="text-center"> {{ $client->email}} </td>
                         <td  class="text-center"> {{ $client->phone}} </td>     
                         <td  class="text-center"> {{ $client->city->name}} </td>
                         <td  class="text-center"> {{ $client->birth_date}} </td>
                         <td  class="text-center"> {{ $client->date_of_last_donation}} </td>
                         <td  class="text-center"> {{$client->bloodType->type}}  </td>
                         <td  class="text-center"> {{ $client->activated ?"Active":"Deactivated"}} </td>
                        

                        </tr>
                 
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
  