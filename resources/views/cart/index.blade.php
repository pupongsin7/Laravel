@extends('layouts.master')
@section('title') BikeShop | ตะกร้าสินค้า
@endsection
@section('content')

<div class="container" style="background-color:rgba(0, 0, 0, 0.5);padding:20px 20px;">
    <h1 style="color:white;">สินค้าในตะกร้า</h1>
    <div class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i>หน้าร้าน</a></li>
        <li class="active" >สินค้าในตะกร้า</li>
    </div>
    <div class="panel panel-default">
        @if(count($cart_items))
        <?php   $sum_price = 0; 
                $sum_qty = 0; 
        ?>
        <table class="table bs-table">
            <thead>
                <tr>
                    <th>รูปสินค้า</th>
                    <th>รหัส</th>
                    <th>ชื่อสินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคา</th>
                    <th>ราคารวม</th>
                    <th width="50px"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart_items as $c)
                <tr>
                    <td><img src="{{asset($c['image_url'])}}" height="36"></td>
                    <td>{{$c['code']}}</td>
                    <td>{{$c['name']}}</td>
                    <td><input type="number" class="form-control" min=1 style="width:20%;"value="{{$c['qty']}}" onKeyUp="updateCart({{$c['id']}},this)"></td>
                    <td>{{number_format($c['price'],0)}}</td>
                <?php $sum_item = $c['price']*$c['qty']; ?>
                    <td>{{number_format($sum_item,0)}}</td>
                    <td><a href="{{URL::to('cart/delete/'.$c['id'])}}" class="btn btn-danger"><i class="fa fa-times"></i></a></td>
                </tr>
                <?php
                $sum_price += $sum_item;
                $sum_qty += $c['qty'];
                ?>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" style="text-align: center">รวม</th>
                    <th>{{number_format($sum_qty,0)}}</th>
                    <th></th>
                    <th>{{number_format($sum_price,0)}}</th>
                    <th>บาท</th>
                </tr>
            </tfoot>
        </table>
        @else
        <div class="panel-body"><strong>ไม่พบรายการสินค้า++</strong></div>
        @endif
    </div>
    <a href="{{URL::to('/home')}}" class="btn btn-default">ย้อนกลับ</a>
    <div class="pull-right">
    <a href="{{URL::to('cart/checkout')}}" class="btn btn-primary"><i class="fa fa-chevron-right"></i>ชำระเงิน</a>
    </div>
</div>
<script>
    function updateCart(id,qty){
        if(qty.value > 0)window.location.href = '/cart/update/'+id+'/'+qty.value;
      
    }
</script>
@endsection