<?php
namespace App\Helpers\User;
class CartHelper{
    function totalMoney($cartList){
        $total=0;
        foreach($cartList as $key=>$value):{
            $total+=$value->product_price*$value->product_amount;
        }
        endforeach;
        return $total;
    }
}