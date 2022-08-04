<?php
use App\Http\Services\Admin\CategoryService;
function getAllCategories(){
    $category=new CategoryService();
    return $category->getCategory();
}
function a(){
    return "a";
}