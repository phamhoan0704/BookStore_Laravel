<?php
namespace App\Http\Services\User;
use Exception;
use App\Models\Author;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class CartService{
    protected $table='cart_product';

    public function getAuthor(){    
        $author=DB::table($this->table)
        ->get();
        return $author;
    }
   public function getCartList(){
//     if(Session::has('loginId')){
//     print(Session::get('loginId'));
  
//    }
    $id=session()->get('loginId');
    $cartList=DB::table($this->table)
    ->join('products', 'cart_product.product_id', '=', 'products.id')
    ->where('cart_id',$id)
    ->get();
  
    return $cartList;
  
    }
    public function add($dataInsert){
        $id=session()->get('loginId');
        $productItem=DB::table($this->table)
        ->where('cart_id',$id)
        ->where('product_id',$dataInsert->id)
        ->first();
        if(empty($productItem)){
            DB::table($this->table)->insert([
                'cart_id'=>$id,
                'product_id'=>$dataInsert->id,
                'product_amount'=>1
            ]);
        }
        else{
            $product_amount=$productItem->product_amount;
            $product_amount+=1;
            DB::table($this->table)
            ->where('cart_id',$id)
            ->where('product_id',$dataInsert->id)
            ->update([
                'product_amount'=>$product_amount,
            ]);
        }
        

    }
    public function delete($id)
    {
        $user_id=session()->get('loginId');
        try{
           $cartItem= DB::table($this->table)
            ->where('cart_id',$user_id)
            ->where('product_id',$id)
            ->delete();
         
        }catch(Exception $err){
            session()->flash('error','Có lỗi xảy ra. Vui lòng thử lại!');
        }

    }
    public function deleteCart()
    {
        $user_id=session()->get('loginId');
        try{
           $cartItem= DB::table($this->table)
            ->where('cart_id',$user_id)
            ->delete();
        }catch(Exception $err){
            session()->flash('error','Có lỗi xảy ra. Vui lòng thử lại!');
        }
    }

    public function update($amount){
        foreach($amount as $key =>$item){
            
            try{
                DB::table($this->table)
                ->where('product_id','=',$key)
                ->update([
                    'product_amount'=>(double)$item,
                    'updated_at'=>date('y-m-d'),
                ]);
                
            }catch(Exception $err){
                session()->flash('error','Có lỗi xảy ra. Vui lòng thử lại!');
            }
        }

    }

}