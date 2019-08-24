@extends('layouts.app')
@inject('perm', 'App\Permission')

@section('page_title',__('lang.create new role'))
                 
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
          <form action="{{ action('RoleController@store') }}" method="post"  autocomplete="off">        
              <div class="form-group">
                <label for="my-input">@lang('lang.role name')</label>
              <input id="my-input" class="form-control" type="text" name="name" placeholder=" Enter role's name" value="{{old('name')}}">
                <span class=" text-danger"> {{ $errors->first('name') }}</span>
              </div>

              <div class="form-group">
                  <label for="my-image">@lang('lang.display name')</label>
                  <input id="my-display_name" class="form-control" type="text" name="display_name" placeholder=" Enter role's Display name"value="{{old('display_name')}}">
                      <span class=" text-danger"> {{ $errors->first('display_name') }}</span>
                </div>

              <div class="form-group">
                <label for="my-text"> @lang('lang.description')  </label>
                <textarea id="my-text" class="form-control" name="description"  placeholder=" Enter role's description" cols="30" rows="10" >
                  {{ old('description')}}
                </textarea>
                <span class=" text-danger"> {{ $errors->first('description') }}</span>
              </div>

              <div class="form-group">
                <label >@lang('lang.permissions')</label><br>
                <input id="select-all" type="checkbox"><label for='select-all'>@lang('lang.select all')</label>
               <div class="row">
                  @foreach ($perm->all() as $permission)
                    <div class="col-sm-3">
                    <input type="checkbox" name="permissions_list[]" value="{{$permission->id}}">{{$permission->display_name}}
                    </div>
                  @endforeach
                </div>
              </div>
                                   
              <button type="submit" class="btn btn-primary btn-lg" ><i class="fa fa-plus"></i> @lang('lang.add')  </button>
              @push('scripts')
              <script> 
                 $("#select-all").click(function(){
                  $("input[type=checkbox]").prop('checked',
                  $(this).prop('checked'));
                 });
              </script>
              @endpush
            @csrf
          </form>
        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

@endsection
  