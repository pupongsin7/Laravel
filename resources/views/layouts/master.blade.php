<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','จักรยาน')</title>
    
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/toastr/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/kmutnb.css')}}">
</head>

<body style ="background-image: url({{asset('bg/bg-home3.jpg')}}); ">
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/Chart.min.js')}}"></script>
    <script src="{{asset('js/angular.min.js')}}"></script>
    {{-- <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script> --}}
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
    <script src="{{asset('vendor/toastr/toastr.min.js')}}"></script>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="/" class="navbar-brand">BikeShop</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ URL::to('home/') }}">หน้าแรก</a></li>
                    @guest
                    @else
                    <li><a href="{{ URL::to('product/') }}">จัดการข้อมูลสินค้า</a></li>
                    <li><a href="{{ URL::to('chart/') }}">รายงาน</a></li>
                    @endguest
                </ul>
                <ul class="nav navbar-nav navbar-right">
                @guest
                <li><a href="{{route('login')}}">ล็อกอิน</a></li>
                <li><a href="{{route('register')}}">ลงทะเบียน</a></li>
                @else
                <li><a href="{{URL::to('cart/view')}}"><i class="fa fa-shopping-cart"></i>ตะกร้า <span class="label label-danger">{!! count(Session::get('cart_items')) !!}</span></a></li>
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" role="button">{{Auth::user()->name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown"><a href="{{URL::to('/logout')}}" >logout</a></li>
                    </ul>
                  </li>
                {{-- <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="#">Separated link</a></li>
                    </ul>
                  </li> --}}
                
            </ul>
                @endguest
               
            </div>
        </div>
    </nav>
    {{-- <div class="header-kmutnb"></div> --}}
    
    @yield('content');
    <!-- js -->
    @if(session('msg'))
        @if(session('ok'))
            <script> toastr.success("{{ session('msg') }}")</script>
        @else
            <script> toastr.error("{{ session('msg') }}")</script>
        @endif
    @endif
    <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>

</body>

</html>