<?php
namespace App\Http\Services\User;
use Exception;
use App\Models\Author;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class OrderProductService{
    protected $table='order_product';


    public function add($dataInsert,$order_id)
    {
        
        try{
            foreach($dataInsert as $key=>$item){
                // dd($item[$key]->product_id);
                DB::table($this->table)->insert([
                    'product_id'=>(Int)$item->product_id,
                    'order_id'=>(Int)$order_id,
                    'product_amount'=>(Int)$item->product_amount,
                    'product_price'=>(double)$item->product_price,
                    'created_at'=>date('y-m-d H:i:s'),
                ]);
            }
            
        }catch(Exception $err){
            dd($err);
            session()->flash('error',$err);
            return false;
        }  
        return true;

    }

    public function getOrderProductList($order_id){
        $orderProductList=DB::table($this->table)
        ->join('products', 'order_product.product_id', '=', 'products.id')
        ->where('order_id',$order_id)
        ->get();
        return $orderProductList;

    }

}