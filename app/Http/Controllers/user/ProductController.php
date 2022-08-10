<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\admin\ProductRequest;
use App\Http\Services\Admin\ProductService;
use App\Http\Services\Admin\CategoryService;
use App\Models\Category;


class ProductController extends Controller
{
    //
    protected $productService;
    protected $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService=$productService;
        $this->categoryService=$categoryService;
    }

    public function index(){

        $productList=$this->productService->getNewProduct();
        $categoryList=$this->categoryService->getCategoryList();
        
        return view('user.home',compact(['productList','categoryList']));
    }

    public function getProductByCategory($id){

        $productList=$this->productService->getProductByCategory($id);
        $categoryList=$this->categoryService->getCategoryList();
        // dd($categoryList);
        // dd($productList);
        return view('user.productCategory',compact(['productList','categoryList']));
    }

    public function searchProduct(Request $request){
        $search = $request->search;
        $categoryList=$this->categoryService->getCategoryList();
        $searchList=$this->productService->searchProduct($search);
        $searchInfo = $search;
        return view('user.search',compact(['searchList','searchInfo','categoryList']));
    }
    
}
