<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Services\User\CartService;
use Illuminate\Http\Request;
use App\Http\Services\Admin\CategoryService;
use App\Http\Services\Admin\ProductService;
use App\Http\Services\User\UserService;
use App\Models\Cart;

class CartController extends Controller
{
    protected $cartService;
    protected $categoryService;
    protected $productService;
    protected $userService;
    
    



    
    public function __construct(CartService $cartService,CategoryService $categoryService,ProductService $productService,UserService $userService)
    {
        $this->cartService=$cartService;
        $this->categoryService=$categoryService;
        $this->productService=$productService;
        $this->userService=$userService;
    }
    public function index(){
        $cartList=$this->cartService->getCartList();
        $categoryList=$this->categoryService->getCategoryList();
        $data=$this->userService->getUser();
        return view('user.cart',compact(['cartList','categoryList','data']));
    }
    public function delete( Request $request){
        $id=$request->id;
        if(!empty($id)){
            $this->cartService->delete($id);
        return redirect()->back();
        }
    }
    
    public function update( Request $request){
        $amount=$request->amount;
        $this->cartService->update($amount);
        return redirect()->route('user.cart.index');
    }
    public function add(Request $request){
        $product_id=$request->id;
        $numproduct=$request->numproduct;
        //dd($product_id);
        
         if(empty($numproduct))
         $numproduct=1;
        $dataInsert=$this->productService->getDetailProduct($product_id)[0];
        if($dataInsert->product_quantity>0){
            $this->cartService->add($dataInsert,$numproduct);
        }else{
            
        }

        return redirect()->route('user.cart.index');
    }

}
