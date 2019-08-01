@extends('layouts.app')

@section('page_title','Contacts search')
                 
@section('content')     
  <!-- Main content -->
  <section class="content">

      <br>
      <form action="{{ action('ContactController@search')}}" method="get" autocomplete="off" >
        <label for="s"> Search Box </label>
        <input  id="s" type="text" name="query" placeholder="Search Contacts .." value="{{request()->input('query')}}" class="form-control" > 
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
          <p>result(s) found for <b>'{{ request()->input('query')}}'</b>   search</p>
          @if (count($contacts))
              <table class="table table-bordered">
                <tbody>

                  <tr>
                    <th style="width: 10px">#</th>
                    <th class="text-center"> client name</th>
                    <th  class="text-center"> title</th>
                    <th  class="text-center"> message</th>
                    <th class="text-center">Delete</th>


                  </tr>
                  @foreach ($contacts as $contact)
                      <tr>
                         <td> {{ $loop->iteration}} </td>
                         <td  class="text-center">  {{ $contact->client->name }} </td>

                         <td  class="text-center">  {{ $contact->title }} </td>
                         
                         
                            <td  class="text-center"> {{ $contact->message}} </td>     
                         
                         <td  class="text-center">
                            <form action="{{action('ContactController@destroy',$contact->id)}}" method="contact">
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
  