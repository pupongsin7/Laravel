@extends('layouts.master')
@section('title') BikeShop | รายงาน
@endsection
@section('content')


<div class="container" style="background-color:rgba(0, 0, 0, 0.5);padding:20px 20px;">
    <h1 style="color:white;">รายงาน</h1>
    <div class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i>หน้าแรก</a></li>
        <li class="active">รายงาน</li>
    </div>
    <div class="panel panel-defualt">
        <div class="panel-heading">
            <strong>มูลค่าสินค้า</strong>
        </div>
        <div class="panel-body">
            <canvas id="myBarChart" height="100"></canvas>
            
        </div>
        <div class="panel-body">
                
                <canvas id="myBarChart1" height="100"></canvas>
            </div>
    </div>
</div>
<script type="text/javascript">
    var ctx = document.getElementById("myBarChart").getContext('2d');
    var myChart = new Chart(
        ctx, {
            type: 'bar',
            data: {
                labels: ["สินค้า 1", "สินค้า 2", "สินค้า 3", "สินค้า 4"],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5],
                    backgroundColor: [
                        'rgba(255,99,132,0.6)',
                        'rgba(255,99,132,0.6)',
                        'rgba(255,99,132,0.6)',
                        'rgba(255,99,132,0.6)'
                    ],
                    borderColor:[
                        'rgba(255,99,200,1)',
                        'rgba(255,99,200,1)',
                        'rgba(255,99,200,1)',
                        'rgba(255,99,200,1)'
                    ]
                }]
            },

            options: {
                scales: {
                    yAxes: [{ ticks: { beginAtZero: true } }]
                }
            }
        }
    );
    var ctx = document.getElementById("myBarChart1").getContext('2d');
    var myChart = new Chart(
        ctx, {
            type: 'pie',
            data: {
                labels: ["สินค้า 1", "สินค้า 2", "สินค้า 3", "สินค้า 4"],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5],
                    backgroundColor: [
                        'rgba(255,99,132,0.6)',
                        'rgba(255,99,132,0.6)',
                        'rgba(255,99,132,0.6)',
                        'rgba(255,99,132,0.6)'
                    ],
                   
                }]
            },

            options: {
                scales: {
                    yAxes: [{ ticks: { beginAtZero: true } }]
                }
            }
        }
    );
</script>



@endsection