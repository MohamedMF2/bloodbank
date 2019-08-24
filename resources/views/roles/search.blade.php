@extends('layouts.app')

@section('page_title','Posts search')
                 
@section('content')     
  <!-- Main content -->
  <section class="content">

      <br>
      <form action="{{ action('PostController@search')}}" method="get" autocomplete="off" >
        <label for="s"> Search Box </label>
        <input  id="s" type="text" name="query" placeholder="Search posts .." value="{{request()->input('query')}}" class="form-control" > 
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
          @if (count($posts))
              <table class="table table-bordered">
                <tbody>

                  <tr>
                    <th style="width: 10px">#</th>
                    <th  class="text-center"> title</th>
                    <th  class="text-center"> content</th>
                    <th class="text-center"> edit</th>
                    <th class="text-center">Delete</th>


                  </tr>
                  @foreach ($posts as $post)
                      <tr>
                         <td> {{ $loop->iteration}} </td>
                         <td  class="text-center">  <a href="{{url(route('post.show',$post->id))}}"> {{ $post->title }}</a> </td>
                         <td  class="text-center"> {{ $post->content}} </td>     
                         
                         <td class="text-center"> 
                            <a href="{{ url(route('post.edit',$post->id)) }}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> </a>

                         </td>
                         <td  class="text-center">
                            <form action="{{action('PostController@destroy',$post->id)}}" method="post">
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
  