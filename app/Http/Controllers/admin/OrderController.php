<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\User\CartService;
use App\Http\Services\Admin\CategoryService;
use App\Http\Services\Admin\OrderService;

use App\Http\Requests\user\OrderRequest;
use App\Http\Services\Admin\ProductService;
use App\Http\Services\User\UserService;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $cartService;
    protected $categoryService;
    protected $orderService;
    protected $orderProductService;
    protected $productService;
   



    public function __construct(OrderService $orderService,ProductService $productService)
    {
        $this->orderService=$orderService;
        $this->productService=$productService;
      
    }
    
    public function getOrderList(Request $request)
    
    {
        $status=$request->status;
        $orderList=$this->orderService->getOrderListActive($status);
        $count[0]=$this->orderService->getCount('6');
        $count[1]=$this->orderService->getCount('0');
        $count[2]=$this->orderService->getCount('1');
        $count[3]=$this->orderService->getCount('2');
        $count[4]=$this->orderService->getCount('3');
        $count[5]=$this->orderService->getCount('4');
        $search_txt=$request->search_txt;
        $resultSearch= $this->orderService->searchOrder($search_txt);
        return view('admin.order.order_list',compact(['orderList','status','count','resultSearch']));
    }
    public function getDetail(Request $request){
        $orderDetail=$this->orderService->getOrderDetailList($request->id);
        return view('admin.order.orderDetail',compact(['orderDetail']));
    }
    public function destroyOrder(Request $request ){
        try
        {
            $order_id=$request->id;
            $orderDetailList=$this->orderService->getOrderDetailList($order_id);
            //dd($orderDetailList);
            foreach($orderDetailList as $item)
            {
                
                $this->productService->updateQuantity($item->product_id,$item->product_amount);
               
            }
            DB::table('orders')
            ->where('id',$order_id)
            ->update([
                 
                 'order_status'=>4
                 ]);   

            session()->flash('success','Đã hủy đơn hàng');
            return redirect()->back();

        }
        catch(Exception $err)
        {
            session()->flash('fail','Có lỗi, vui lòng thử lại');
        }
    }
    public function updateOrder(Request $request){
        try{
            $order_id=$request->id;
            $res=DB::table('orders')
            ->where('id',$order_id)
            ->update([
                 'payment_status'=>$request->payment_status,
                 'order_status'=>$request->status
                 ]);   
                
          
        session()->flash('success','Cập nhật đơn hàng thành công');
        return redirect()->back();
        }
        catch(Exception $err){
            session()->flash('fail','Có lỗi, vui lòng thử lại');
        }
               


    }
    public function getResultSearch(Request $request){
        $search_txt=$request->search_txt;
        dd($request->search_text);
        $resultSearch= $this->orderService->searchOrder($search_txt);
        return redirect('admin.order.search',compact(['resultSearch']));
    }
    
}
