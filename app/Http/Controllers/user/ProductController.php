<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\admin\ProductRequest;
use App\Http\Services\Admin\ProductService;
use App\Http\Services\Admin\CategoryService;
use App\Http\Services\User\CartService;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Author;
use App\Models\Supplier;



class ProductController extends Controller
{
    
    protected $categoryService;
    protected $cartService;
    protected $productService;

    public function __construct(ProductService $productService, CategoryService $categoryService, CartService $cartService)
    {
        $this->productService=$productService;
        $this->categoryService=$categoryService;
        $this->cartService=$cartService;
    }
  
    public function index(){

        $productList=$this->productService->getNewProduct();
        $productListBestSeller=$this->productService->getListProductBestSeller();
        $categoryList=$this->categoryService->getCategoryList();
        
        $data=array();
        $cartList=$this->cartService->getCartList();
        if(Session::has('loginId')){
            $data=DB::table('users')->where('id','=',Session::get('loginId'))->first();
        } else $cartList=array();
        return view('user.home',compact(['productList','categoryList','data','cartList','productListBestSeller']));

    }

    public function getProductByCategory(){
        $categoryList=$this->categoryService->getCategoryList();
        $category_id='';
        if(!empty(request()->segment(2)))
        {
            $category_id = request()->segment(2);
        }
        $productList=$this->productService->getProductByCategory($category_id);
        
        $data=array();
        $cartList=$this->cartService->getCartList();
        // dd($category_id);
        
        if(Session::has('loginId')){
            $data=DB::table('users')->where('id','=',Session::get('loginId'))->first();
        }
        // dd($category_id);
        return view('user.productCategory',compact(['productList','categoryList','data','cartList','category_id']));
    }

    public function searchProduct(Request $request){
        $search = $request->search;
        $categoryList=$this->categoryService->getCategoryList();
        $searchList=$this->productService->searchProduct($search);
        $searchInfo = $search;
        $cartList=$this->cartService->getCartList();
        $data=array();
        if(Session::has('loginId')){
            $data=DB::table('users')->where('id','=',Session::get('loginId'))->first();
        }
        return view('user.search',compact(['searchList','searchInfo','categoryList','data','cartList']));
    }
    
    //hien thi  thong tin san pham
    public function showProductDetail(Request $request,$id){
        $productList=$this->productService->getProductByCategory($id);
        $categoryList=$this->categoryService->getCategoryList();
        $id=$request->id;
        $product=DB::table('Products')->where('id','=',$id)->first();
        $author=DB::table('Authors')->where('id',$product->author_id)->first();
        $supplier=DB::table('Suppliers')->where('id',$product->supplier_id)->first();
        $data=array();
        if(Session::has('loginId')){
            $cartList=$this->cartService->getCartList();
            $data=DB::table('users')->where('id','=',Session::get('loginId'))->first();
        }
        
    return view('user.product_detail', compact(['productList','categoryList','product','author','supplier','data','cartList']));

    }
   
    
    
}
