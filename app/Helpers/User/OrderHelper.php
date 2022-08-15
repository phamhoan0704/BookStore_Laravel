<?php
namespace App\Helpers\User;
class OrderHelper{
    function delivery_fee($totalMoney){
        $delivery_fee=0;
        if($totalMoney>1000000){
            $delivery_fee=0;
        }
        else if($totalMoney<1000000){
            $delivery_fee=25000;
        }
        return $delivery_fee;

    }
}