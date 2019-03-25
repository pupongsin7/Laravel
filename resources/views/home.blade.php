@extends('layouts.master')
@section('title') BikeShop | อุปกรณ์จักรยาน , อะไหล่ , ชุดแข่ง และอุปกรณ์ตกแต่ง
@endsection
@section('content')
<script type="text/javascript">
    var app = angular.module('app', []).config(function ($interpolateProvider) {
        $interpolateProvider.startSymbol('@{').endSymbol('}');
    });

    app.service('productService', function ($http) {
        this.getProductList = function (category_id) {
            if (category_id) {
                return $http.get('/api/product/' + category_id);
            }
            return $http.get('/api/product');
        };
        this.getCategoryList = function () {
            return $http.get('/api/category');
        };
        this.searchProduct = function (query) {
            return $http({
                url: '/api/product/search',
                method: 'post',
                data: { 'query': query },
            });
        }
    });


    app.controller('ctrl', function ($scope, productService) {
        $scope.helloMessage = 'ยินดีต้อนรับสู่ AngularJs';
        // $scope.products = [
        //     {'code':'P001','name':'ชุดแข่งสีดำ Size L','price':'1500.00','stock_qty':'10'},
        //     {'code':'P002','name':'หมวกกันน็อค','price':'1600.00','stock_qty':'0'},
        //     {'code':'P003','name':'ชุดแข่งสีดำ Size XXL','price':'1700.00','stock_qty':'4'},

        // ];
        $scope.addToCart = function (p) {
            window.location.href = '/cart/add/' + p.id;
        };
        $scope.getProductList = function (category) {
            $scope.category = category;
            category_id = category != null ? category.id : '';
            productService.getProductList(category_id).then(function (res) {
                //if(!res.data.ok)return;  //ถ้าไม่มี data จะย้อนกลับไป

                $scope.products = res.data.products;
            });
        };
        $scope.getCategoryList = function () {
            productService.getCategoryList().then(function (res) {
                //if(!res.data.ok)return;  //ถ้าไม่มี data จะย้อนกลับไป
                $scope.test = res;
                $scope.categories = res.data.categories;
            });
        };
        $scope.searchProduct = function (e) {
            productService.searchProduct($scope.query).then(function (res) {
                if (!res.data.ok) return;
                $scope.products = res.data.products;
            });
        };

        $scope.getProductList(null);
        $scope.getCategoryList();
    });



</script>
<div class="container" style="background-color:rgba(0, 0, 0, 0.5);padding:20px 20px;" ng-app="app" ng-controller="ctrl">

    <div class="row">
        <div class="col-md-3">
            <h1 style="margin: 0px 0 30px 0; color:white">สินค้าในร้าน</h1>
        </div>
        <div class="col-md-9">
            <div class="pull-right" style="margin-top:10px">
                <input type="text" class="form-control" ng-model="query" ng-keyup="searchProduct($event)"
                    style="width:190px" placeholder="พิมพ์ชื่อสินค้าเพื่อค้นหา">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="#" class="list-group-item" ng-class="{'active' : category == null}"
                    ng-click="getProductList(null)">ทั้งหมด</a>
                <a href="#" class="list-group-item" ng-repeat="c in categories"
                    ng-class="{'active': category.id == c.id}" ng-click="getProductList(c)">@{c.name}</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-3" ng-repeat="p in products | filter:query">
                    <div class="panel panel-default bs-product-card" style="background-color:rgba(255, 255, 255, 0.8);padding:2px 2px 2px 2px;">
                        <div class="panel-body">
                            <img src="@{p.image_url}" class="">
                            <h4><a href="#">@{p.name}</a></h4>
                            <div class="form-group">
                                <div>คงเหลือ @{p.stock_qty}</div>
                                <div>ราคา <strong>@{p.price}</strong> บาท</div>
                            </div>
                            <a href="#" class="btn btn-success btn-block" ng-click="addToCart(p)"><i
                                    class="fa fa-shopping-cart"></i> หยิบใส่ตะกร้า</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h1 ng-if="!products.length" align=center style="color:red">ไม่พบข้อมูลสินค้า</h1>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- <div class="container" ng-app="app" ng-controller="ctrl">
        <h1 style="color:red;">@{helloMessage}</h1>
        <h1 style="color:green;">@{helloMessage}</h1>
        <h1 style="color:blue;">@{helloMessage}</h1>
        <h1 style="color:yellow;">@{helloMessage}</h1>
        <input type="text" name="test" class="form-control" ng-model="helloMessage">
        <br>
        <div style="color:red;" ng-if="!products.length">
            <h3 align=center>ไม่พบข้อมูลสินค้า</h3>
        </div>
        <div class="panel panel-primary" ng-if="products.length">
            <div class="panel panel-heading">
                <strong>แสดงข้อมูล</strong>
            </div>
            <div class="panel panel-body">
                <div>
                    <input type="text" name="search" style="width:250px;float:right" class="form-control" ng-model="query.name" placeholder="พิมพ์คำที่ต้องการค้นหา">
                </div>
                    <br>
                    <br>
                    <br>
                <table class="table table-bordered" >
                    <thead>
                        <tr>
                            <th>รหัส</th>
                            <th>ชื่อสินค้า</th>
                            <th>ราคาขาย</th>
                            <th>คงเหลือ</th>
                            <th>สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="p in products|filter:query">
                            <td>@{p.code}</td>
                            <td>@{p.name}</td>
                            <td>@{p.price}</td>
                            <td>@{p.stock_qty}</td>
                            <td>
                                <span ng-class="{'label label-warning': p.stock_qty > 0 && p.stock_qty < 5}" ng-if="p.stock_qty > 0 && p.stock_qty < 5">สินค้าใกล้หมด</span>
                                <span ng-class="{'label label-danger': p.stock_qty == 0}" ng-if="p.stock_qty == 0">สินค้าหมด</span></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" align="right">รวม</td>
                            <td align="center">@{sum}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div> --}}


@endsection