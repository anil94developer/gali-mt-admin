@include('administrator.includes.head')
<body>
<!-- Preloader -->
<div class="preloader-it">
    <div class="la-anim-1"><img class="loader" src="{{asset('administrator/images/loading.gif') }}"></div>
</div>
<!-- /Preloader -->
<div class="wrapper theme-1-active pimary-color-red">
    @include('administrator.includes.header')

    @include('administrator.includes.left_sidebar')
    <div class="container-fluid">
    <div class="page-wrapper">

 @if(Session::has('success_message'))
    <div class="alert alert-success alert-dismissable" id="successMessage">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="zmdi zmdi-check pr-15 pull-left"></i><p class="pull-left">{{ Session::get('success_message') }}</p>
        <div class="clearfix"></div>
    </div>
 @endif
 @if(Session::has('error_message'))
    <div class="alert alert-info alert-dismissable" id="successMessage">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="zmdi zmdi-info-outline pr-15 pull-left"></i><p class="pull-left">{{ Session::get('error_message') }}</p>
        <div class="clearfix"></div>
    </div>
 @endif
  @yield('content')

  <footer class="footer container-fluid pl-30 pr-30">
    <div class="row">
        <div class="col-sm-12 text-center">
            <p>2025 &copy;  Playonlineds</p>
        </div>
    </div>
</footer>
</div>
</div>
</div>
@include('administrator.includes.footer')
@stack('scripts')
<script>
      setTimeout(function(){
          $("#successMessage").css("display", "none");
          }, 3000);
</script>
</body>
</html>

