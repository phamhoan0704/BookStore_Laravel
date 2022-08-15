<?php
namespace App\Http\Services\User;
use Exception;
use App\Models\Author;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class OrderService{
    protected $table='orders';
    public function add($dataInsert)
    {
        $user_id=session()->get('loginId');
        try{
            print("1");
            DB::table($this->table)->insert([
                'name'=>(String)$dataInsert['name'],
                'phone'=>(Int)$dataInsert['phone'],
                'email'=>(String)$dataInsert['email'],
                'address'=>(String)$dataInsert['address'],
                'total_money'=>(double)$dataInsert['total_money'],
                'order_status'=>0,
                'order_note'=>(String)$dataInsert['note'],
                'delivery_money'=>(double)$dataInsert['delivery_money'],
                'payment_method'=>$dataInsert['payment_method'],
                'payment_status'=>0,
                'user_id'=>$user_id,
                'order_date'=>date('y-m-d H:i:s'),
                'created_at'=>date('y-m-d H:i:s'),
            ]);
            $order_id=DB::table($this->table)
            ->select('id')
            ->orderBy('created_at','DESC')
            ->first();

            $order_id=$order_id->id;
            
         session()->flash('success','Đặt hàng thành công!');
        }catch(Exception $err){
            dd($err);
            session()->flash('error',$err);
            return false;
        }  
        return $order_id;

    }
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



}