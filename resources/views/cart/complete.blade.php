<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ใบสั่งซื้อเลขที่{{$po_no}}
    </title>
</head>
<style>
body{
    font-family: "Garuda",sans-serif;
}
</style>
<body>
    <table border="0" width="100%">
        <tr>
            <td colspan="2" align="center">
                <h1>ใบสั่งซื้อ</h1>
                <h2>(Purchase Order)</h2>
            </td>
        </tr>
        <tr>
            <td>
                <table border="0" width="100%">
                <tr><td colspan="2"><strong>ชื่อลูกค้า :</strong>&nbsp;{{$cus_name}}</td></tr>
                <tr><td colspan="2"><strong>อีเมล์ : </strong>&nbsp;{{$cus_email}}</td></tr>
                </table>
            </td>
            <td>
                <table width="100%">
                    <tr><td><strong>เลขที่:</strong></td><td>{{$po_no}}</td></tr>
                    <tr><td><strong>วันที่:</strong></td><td>{{$po_date}}</td></tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table border="1" width="100%" cellspacing="0" cellpadding="0">
                    <thead>
                        <th>ลำดับ</th>
                        <th>ชื่อสินค้า</th>
                        <th>ราคา/หน่วย</th>
                        <th>จำนวน</th>
                        <th>รวมเงิน</th>
                    </thead>
                    <tbody>
                        @foreach($cart_items as $c)
                        <tr>
                        <td align="center">{{$loop->iteration}}</td>
                        <td>{{$c['name']}}</td>
                        <td align="right">{{number_format($c['price'],0)}}</td>
                        <td align="right">{{number_format($c['qty'],0)}}</td>
                        <td align="right">{{number_format($c['price'],0)}}</td>
                        </tr>
                        <?php $total_amount += $c['price']*$c['qty']; ?>
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <h4>หมายเหตุ</h4>
                <ul>
                    <li>ชำระเงินโดยโอนเงินเข้าบัญชี XXXXXXX ธนาคาร YYYYYY สาขา ZZZZ (ออมทรัพย์)</li>
                    <li>กรุณาชำระเงินภายใน 7 วัน หลังจากที่สั่งซื้อ</li>
                    <li>ชำระเงินแล้วส่งหลักฐานมาที่  sales@bikeshop.com หรือ LINE: @bikeshop</li>
                </ul>
            </td>
        <td align="right"><strong>จำนวนเงินรวมทั้งสิ้น</strong> <h1>{{number_format($total_amount,0)}} บาท</h1></td>
        </tr>
    </table>
</body>

</html>