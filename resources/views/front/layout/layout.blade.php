<!doctype html>
<html>
@include('front.includes.head')
<body>

<div class="main"> 

  @include('front.includes.header')
  @yield('content')
  @include('front.includes.footer')

  @yield('scripts')

</div>
</body>
</html>
