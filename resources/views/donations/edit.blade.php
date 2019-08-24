@extends('layouts.app')
@section('page_title',' Edit '. $client ->name.' Status')
                 
@section('content')     
  <!-- Main content -->
  <section class="content">
   
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

          <!---------------------------- Form  ------------------------------------>
          
          <form action="{{ action('ClientController@update',$client->id) }}" method="post" autocomplete="off">        
            @method('PUT')
              <div class="form-group">
                <label for="my-input">Status</label>
                <select name="activated" id="my-input" class="form-control">
                  <option  disabled> choose client status</option>
                  <option value="1" {{ $client->activated =="Active" ?'selected':''}}> Activate </option>
                  <option value="0" {{ $client->activated =="Deactivate" ?'selected':''}}> Deactivate </option>
                </select>
                <span class=" text-danger"> {{ $errors->first('activated') }}</span>
              </div>
              <button type="submit" class="btn btn-primary" > Save </button>
            @csrf
          </form>
          <!----------------------------  End Of Form  ------------------------------------>

        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

@endsection
  