<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Services\User\CartService;
use Illuminate\Http\Request;
use App\Http\Services\Admin\CategoryService;
use App\Http\Services\Admin\ProductService;
use App\Models\Cart;

class CartController extends Controller
{
    protected $cartService;
    protected $categoryService;
    protected $productService;


    
    public function __construct(CartService $cartService,CategoryService $categoryService,ProductService $productService)
    {
        $this->cartService=$cartService;
        $this->categoryService=$categoryService;
        $this->productService=$productService;
    }
    public function index(){
        $cartList=$this->cartService->getCartList();
        $categoryList=$this->categoryService->getCategoryList();
        return view('user.cart',compact(['cartList','categoryList']));
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
        $dataInsert=$this->productService->getDetailProduct($product_id)[0];
        if($dataInsert->product_quantity>0){
            $this->cartService->add($dataInsert);
        }else{
            
        }

        return redirect()->route('user.cart.index');
    }

}
