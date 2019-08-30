@extends('layouts.app')

@section('page_title','App Settingss')
                 
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
            @if ($settings)
              <table class="table table-bordered">
                <tbody>
                    @foreach ($settings as $setting)
                  <tr>
                    <th ><h5><i class="fa fa-phone bg-success"></i> Phone </h5></th>
                    <td  > <a>{{ $setting->phone}} </a></td>
                  </tr>
                  <tr>  
                    <th ><h5> <i class="fa fa-mail "></i> Email </h5></th>
                    <td  ><a>  {{$setting->email }}  </a></td>
                  </tr>
                  <tr>  
                    <th ><h5><i class="fa fa-facebook bg-blue"></i> Facebook</h5></th>
                    <td><a>  {{$setting->facebook}}</a></td>

                  </tr>
                  <tr>  
                    <th ><h5><i class="fa fa-twitter text-primary"></i> Twitter</h5></th>
                    <td><a>  {{$setting->twitter}}</a></td>

                  </tr>
                  <tr>  
                    <th ><h5> <i class="fa fa-instagram bg-danger"></i> Instagram</h5></th>
                    <td><a>  {{$setting->instagram}}</a></td>

                  </tr>
                  <tr>   
                    <th ><h5><h5><i class="fa fa-youtube text-danger "></i> Youtube<h5></h5></th>
                    <td><a>  {{$setting->youtube}}</a></td>

                  </tr>
                  <tr>  
                    <th ><h5><i class="fa fa-google-plus text-danger"></i> Google</h5></th>
                    <td><a>  {{$setting->google}}</a></td>

                  </tr>
                  <tr>  
                    <th ><h5><i class="fa fa-whatsapp bg-success"></i> WhatsApp</h5></th>
                    <td><a>  {{$setting->whatsapp}}</a></td>

                  </tr>
                  <tr>  
                    <th ><h5><i class="fa fa-linkedin bg-primary"></i> Linkedin</h5></th>
                    <td><a>  {{$setting->linkedin}}</a></td>

                  </tr>
                  <tr>  
                    <th ><h5><i class="fa fa-app "></i> About App</h5></th>
                    <td><a>  {{$setting->about}}</a></td>

                  </tr>
                  <tr> 
                  <td  class="text-center"> 
                      <a href="{{ url(route('setting.edit',$setting->id)) }}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> </a>
                    </td> 
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
  