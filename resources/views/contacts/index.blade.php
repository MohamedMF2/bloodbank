@extends('layouts.app')

@section('page_title',__('lang.contacts'))
                 
@section('content')     
  <!-- Main content -->
  <section class="content">
   
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <form action="{{ action('ContactController@search')}}" method="get" autocomplete="off">
                <input type="text" name="query" placeholder="@lang('lang.search') .." value="{{request()->input('query')}}" class="form-control" > 
                <span class="text-danger"> {{ $errors->first('query')}}</span>
             </form>
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
            @if ($contacts)
              <table class="table table-bordered">
                <tbody>

                  <tr>
                    <th style="width: 10px">#</th>
                    <th  class="text-center"> @lang('lang.Client Name') </th>
                    <th class="text-center">@lang('lang.title')</th>
                    <th class="text-center">@lang('lang.message')</th>
                    <th class="text-center">@lang('lang.delete')</th>

                  </tr>
                  @foreach ($contacts as $contact)
                      <tr>
                      <td> {{ $loop->iteration}} </td>
                      <td  class="text-center">  {{ $contact->client->name }} </td>
                      <td  class="text-center">  {{ $contact->title}} </td>
                      <td  class="text-center">  {{ $contact->message}} </td>
                      <td  class="text-center">
                        <form action="{{action('ContactController@destroy',$contact->id)}}" method="post">
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
  