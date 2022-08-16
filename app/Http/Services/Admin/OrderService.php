<?php
namespace App\Http\Services\admin;
use Exception;
use App\Models\Author;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\TryCatch;

class OrderService{
    protected $table='orders';
  
    public function getOrderDetail($order_id){
        $orderDetail=DB::table($this->table)
        ->where('id',$order_id)
        ->get();
        return $orderDetail;
    }
    public function getOrderList()
    {
        $user_id=session()->get('loginId');
        $orderList=DB::table($this->table)->where('user_id',$user_id)->get();
        return $orderList;
        
    }
    public function getOrderListActive($filters=[]){
        
        if($filters==6){
            $orderListActive=DB::table($this->table)->get();
        }
        else
        $orderListActive=DB::table($this->table)
        ->where('order_status',$filters)
        ->get();
        return $orderListActive;
    }
    
    public function destroyOrder( $order_id){
            try{

        $order= DB::table($this->table)
            ->join('order_product','id','=','order_id')
            ->where('order_id',$order_id);
            //order_status=4
            DB::table('orders')->where('id',$order_id)->update(['order_status'=>'0']);
           $orderlist= Db::table('products')->select('order_id','product_id','product_amount')
            ->join('order_product','prodcut.id','order_product.product_id')->where('order_id',$order_id);
           
            session()->flash('success','Xóa danh mục thành công!');
        }catch(Exception $err){
            session()->flash('error','Có lỗi xảy ra. Vui lòng thử lại!');
        }

    }
    public function getCount($status)
    {
        if($status==6){
            $orderListActive=DB::table($this->table)->get();
        }
        else
        $orderListActive=DB::table($this->table)
        ->where('order_status',$status)
        ->get();
        return $orderListActive->count();
    }
    public function getOrderDetailList($order_id){
        
            $orderDetailList= DB::table($this->table)
            ->join('order_product','id','=','order_id')
            ->where('order_id',$order_id);
            return $orderDetailList;
       
    }



}