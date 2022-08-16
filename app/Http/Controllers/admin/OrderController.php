<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\User\CartService;
use App\Http\Services\Admin\CategoryService;
use App\Http\Services\Admin\OrderService;

use App\Http\Requests\user\OrderRequest;
use App\Http\Services\User\UserService;

class OrderController extends Controller
{
    protected $cartService;
    protected $categoryService;
    protected $orderService;
    protected $orderProductService;
    protected $userService;
   



    public function __construct(OrderService $orderService)
    {
        $this->orderService=$orderService;
      
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
        return view('admin.order.order_list',compact(['orderList','status','count']));
    }
    public function getDetail(Request $request){
        $orderDetail=$this->orderService->getOrderDetailList($request->id);
        return view('admin.order.orderDetail',compact(['orderDetail']));
    }

    
}
