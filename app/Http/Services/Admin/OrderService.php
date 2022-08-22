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
            ->join('order_product','order_product.order_id','=','orders.id')
            ->join('products','.products.id','=','order_product.product_id')
            ->where('orders.id','=',$order_id)->get();
            return $orderDetailList;
       
    }
    public function searchOrder($search){
        if(!empty($search)){
            $search_list=DB::table($this->table)
            ->select('*')
            ->where('id','like','%'.$search.'%')->get();
            if(empty($search_list[0])){
                $titleSearch="Không có kết quả phù hợp";
            }else{
                $titleSearch= $search_list->count();
            }
            $resultSearch=[
                'listSearch'=>$search_list,
                'titleSearch'=>$titleSearch,
            ];
    
        return $resultSearch; 
        }
       
     }
     public function sortOrder($sortBy,$status){
        


     }
     public function getTotal($user_id)
     {
        $totalById=Db::table($this->table)
        ->select('user_id')
        ->sum('total_money')->as('Tong')
        ->groupby('user_id');
        return $totalById;
     }
    


}