<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Admin\CategoryService;

class layoutController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        // $this->categories=new Category();
        $this->categoryService=$categoryService;

    }    public function index(){
       
        $categoryList=$this->categoryService->getAllCategories();
        //Search 

        return view('user.layout_user',compact(['categoryList']));
    }
}
