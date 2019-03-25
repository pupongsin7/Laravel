<?php
namespace App\Helpers;
class Cart{
    public function getCartItems(){
        return Session::get('cart_items');
    }
    public function addToCart($id){
    
    }
    public function updateCart($id,$qty){
    
    }
    public function deleteCart($id){
    
    }
}
?>