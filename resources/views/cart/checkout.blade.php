@extends('layouts.master')
@section('title') BikeShop | ตะกร้าสินค้า
@endsection
@section('content')

<div class="container" style="background-color:rgba(0, 0, 0, 0.5);padding:20px 20px;">
    <h1 style="color:white;">ชำระเงิน</h1>
    <div class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i>หน้าร้าน</a></li>
        <li>สินค้าในตะกร้า</li>
        <li class="active">ชำระเงิน</li>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <strong>รายการสินค้า</strong>
                </div>
                <div class="panel panel-body">
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart_items as $c)
                            <tr>
                                <td><img src="{{asset($c['image_url'])}}" height="36"></td>
                                <td>{{$c['code']}}</td>
                                <td>{{$c['name']}}</td>
                                <td>{{$c['qty']}}</td>
                                <td align=right>{{number_format($c['price'],2)}}</td>
                                <?php $sum_item = $c['price']*$c['qty']; ?>
                                <td align=right>{{number_format($sum_item,2)}}</td>
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
                                <th align=right>{{number_format($sum_price,2)}}</th>
                            </tr>
                        </tfoot>
                    </table>
                    @else
                    <div class="panel-body"><strong>ไม่พบรายการสินค้า++</strong></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <strong>ข้อมูลลูกค้า</strong>
                </div>
                <div class="panel panel-body">
                    
                    <table style="width:100%;">
                        <tbody>
                            <tr>
                                <td><b>ชื่อ-นามสกุล</b></td>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" name="cus_name" id="cus_name"></td>
                            </tr>
                            <tr>
                                <td><b><br></b></td>
                            </tr>
                            <tr>
                                <td><b>อีเมล์</b></td>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" name="cus_email" id="cus_email"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
            <a href="{{URL::to('/cart/view')}}" class="btn btn-default">ย้อนกลับ</a>
        <div class="pull-right">
            <a href="javascript:complete()" class="btn btn-success">พิมพ์ใบสั่งซื้อ</a>
        <a href="{{URL::to('/cart/finish')}}" class="btn btn-primary"><i class="fa fa-check"></i>จบการขาย</a>
            </div>
    </div>
</div>
<script type="text/javascript">
    function complete(){
        window.open("{{URL::to('cart/complete')}}?cus_name="+$('#cus_name').val()+'&cus_email='+$('#cus_email').val(),"_blank");
    }
</script>
    @endsection