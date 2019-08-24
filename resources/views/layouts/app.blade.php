<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@lang('lang.blood bank')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('adminlte/css/skins/_all-skins.min.css')}}">

@if (app()->getLocale()=='ar')
<link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.1.0-alpha-1/css/AdminLTE-rtl.min.css">

<link rel="stylesheet" href="{{asset('adminlte/plugins/font-awesome/css/font-awesome.min.css')}}">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.min.css">
<style>
  body,h1,h2,h3,h4,h5,h6{
    font-family: 'Cairo', sans-serif !important;
  }
</style>

@else
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<link rel="stylesheet" href="{{asset('adminlte/css/AdminLTE.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/font-awesome/css/font-awesome.min.css')}}">



@endif

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
  <a href="{{url('home')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>B</b>Bank</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">{{__('lang.blood bank')}}  </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              @lang('lang.languages')   
            </a>
            <div class="dropdown-menu">
              <ul style="list-style-type: none; margin:2px" class="text-center ">
              @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
              <li style=" padding-bottom:10px" > 
                <a  rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                       {{ $properties['native'] }} 
               </a> 
             </li> 
            @endforeach
          </ul>
            </div>
          </li>

                <div class="pull-right">
                   
                <form action="{{ url('logout')}}" method="post">
                  @csrf
                <button type="submit" class="btn  btn-lg btn-primary "> {{__('lang.logout')}}</button>
                </div>
          
         
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('adminlte/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> 
             {{auth()->user()->name}}
          </p>
          <a href="#"><i class="fa fa-circle text-success"></i>  {{__('lang.online')}}</a>
        </div>
      </div>
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
          
         <!-- <ul class="treeview-menu">-->
            <li><a href="{{url(route('post.index'))}}"><i class="fa fa-list"></i> {{__('lang.posts')}}</a></li>
            <li><a href="{{url(route('category.index'))}}"><i class="fa fa-list"></i> {{__('lang.categories')}}</a></li>
          <!--</ul>-->  
                
        <li><a href="{{url(route('governorate.index'))}}"><i class="fa fa-list"></i> <span>{{__('lang.governorates')}}</span></a></li>

        <li><a href="{{url(route('client.index'))}}"><i class="fa fa-users"></i> <span>{{__('lang.clients')}}  </span></a></li>
        <li><a href="{{url(route('contact.index'))}}"><i class="fa fa-address-card"></i><span>{{__('lang.contacts')}}</span></a></li>

        <li><a href="{{url(route('donation.index'))}}"><i class="fa fa-address-card"><span>{{__('lang.donation requests')}}</i></span></a></li>

        <li><a href="{{url(route('setting.edit'))}}"><i class="fa fa-book"></i> <span>{{__('lang.setting')}}</span></a></li>
        @role('admin')
        <li><a href="{{url(route('user.index'))}}"><i class="fa fa-book"></i> <span>{{__('lang.users')}}</span></a></li>
        <li><a href="{{url(route('role.index'))}}"><i class="fa fa-book"></i> <span>{{__('lang.roles')}}</span></a></li>
        @endrole

        <li><a href="{{url(route('admin.edit'))}}"><i class="fa fa-book"></i> <span>{{__('lang.change password')}}</span></a></li>


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">      
        <h1>  
             @yield('page_title')  
        </h1>
        <small> 
            @yield('small_title')
        </small>   
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> @lang('lang.home')</a>
            </li>
            <li class="active">
                  @yield('page_title') 
            </li>
        </ol>
    </section>
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <strong> @lang('lang.version') 2.4.0 @lang('lang.Copyright') &copy; 2014-2016 <a href="https://adminlte.io"> @lang('lang.ebda3 Studio') </a> @lang('lang.All rights reserved') </strong> <br>
    
    
  </footer>

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('adminlte/plugins/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src=" {{asset('adminlte/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('adminlte/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte/plugins/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/js/demo.js')}}"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
@stack('scripts')
</body>
</html>
