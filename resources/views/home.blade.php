@extends('layouts.app')
@inject('client', 'App\Client')

@section('page_title','Dash Board')
 
@section('small_title','Statistics')
                
@section('content')     
  <!-- Main content -->
  <section class="content">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
    
              <div class="info-box-content">
                <span class="info-box-text">Clients</span>
              <span class="info-box-number">{{ $client->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
    </div>
    <!-- Default box -->
    <div class="box">
      
      <div class="box-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{auth()->user()->name}}   you are logged in!
      </div>
      <!-- /.box-body -->
     
      <!-- /.box-footer-->
     </div>
    <!-- /.box -->

    </section>
  <!-- /.content -->

@endsection
  