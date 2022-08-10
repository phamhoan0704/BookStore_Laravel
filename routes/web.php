<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\admin\AuthorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\NewsController;
use App\Models\Category;
use App\Http\Controllers\CustomAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', function () {
    return view('admin.layout_admin');
});
Route::get('/user', function () {
    return view('user.layout_user');
});
Route::get('/user/cart', function () {
    return view('user.cart');
});
//User 
Route::get('user/cart',[CartController::class, 'index'])->name('user.cart');
Route::get('/user/news' ,[NewsController::class, 'index'])->name('user.news');
//Admin
Route::get('/admin/login',[LoginController::class, 'index'])->name('login');

Route::prefix('/admin')->name('admin.')->group(function(){
    //Category
    Route::prefix('/category')->name('category.')->group(function(){
        // Add
        Route::get('/add',[CategoryController::class,'create'])->name('create');
        Route::post('/add',[CategoryController::class,'postAdd'])->name('postAdd');
        Route::get('/index2',[CategoryController::class,'index'])->name('index2');
        //Index
         Route::get('/{name?}',[CategoryController::class,'index'])->name('index');
        //Edit
        Route::get('/edit/{id}',[CategoryController::class,'getEdit'])->name('edit');
        Route::post('/edit/{id}',[CategoryController::class,'postEdit'])->name('post-edit');
       // Route::post('/update',[CategoryController::class,'postEdit'])->name('post-edit');

       //Hide,show
        Route::post('/activecategory/{name?}/{id?}',[CategoryController::class,'postActive'])->name('active-category');

        //Delete
        Route::post('/delete',[CategoryController::class,'destroy'])->name('delete');
        // Route::post('/deleteall/{id?}',[CategoryController::class,'destroyAll'])->name('deleteall');
    });
    //Product
    Route::prefix('/product')->name('product.')->group(function(){
        // Add
        Route::get('/add',[ProductController::class,'create'])->name('create');
        Route::post('/add',[ProductController::class,'postAdd'])->name('postAdd');
        Route::get('/index2',[ProductController::class,'index'])->name('index2');
        //Index
         Route::get('/{name?}',[ProductController::class,'index'])->name('index');
        //Edit
        Route::get('/edit/{id}',[ProductController::class,'getEdit'])->name('edit');
        Route::post('/edit/{id}',[ProductController::class,'postEdit'])->name('post-edit');
       // Route::post('/update',[CategoryController::class,'postEdit'])->name('post-edit');

       //Hide,show
        Route::post('/activecategory/{name?}/{id?}',[ProductController::class,'postActive'])->name('active-product');

        //Delete
        Route::post('/delete',[ProductController::class,'destroy'])->name('delete');
        Route::post('/deleteall/{id?}',[ProductController::class,'destroyAll'])->name('deleteall');
    });

    //Supplier
    Route::prefix('/supplier')->name('supplier.')->group(function(){
        // Add
        Route::get('/add',[SupplierController::class,'create'])->name('create');
        Route::post('/add',[SupplierController::class,'postAdd'])->name('postAdd');
        Route::get('/index2',[SupplierController::class,'index'])->name('index2');
        //Index
         Route::get('/{name?}',[SupplierController::class,'index'])->name('index');
        //Edit
        Route::get('/edit/{id}',[SupplierController::class,'getEdit'])->name('edit');
        Route::post('/edit/{id}',[SupplierController::class,'postEdit'])->name('post-edit');
       // Route::post('/update',[SupplierController::class,'postEdit'])->name('post-edit');

       //Hide,show
        Route::post('/activecategory/{name?}/{id?}',[SupplierController::class,'postActive'])->name('active-supplier');

        //Delete
        Route::post('/delete',[SupplierController::class,'destroy'])->name('delete');
        // Route::post('/deleteall/{id?}',[SupplierController::class,'destroyAll'])->name('deleteall');
    });

     //Author
     Route::prefix('/author')->name('author.')->group(function(){
        // Add
        Route::get('/add',[AuthorController::class,'create'])->name('create');
        Route::post('/add',[AuthorController::class,'postAdd'])->name('postAdd');
        Route::get('/index2',[AuthorController::class,'index'])->name('index2');
        //Index
         Route::get('/{name?}',[AuthorController::class,'index'])->name('index');
        //Edit
        Route::get('/edit/{id}',[AuthorController::class,'getEdit'])->name('edit');
        Route::post('/edit/{id}',[AuthorController::class,'postEdit'])->name('post-edit');
       // Route::post('/update',[AuthorController::class,'postEdit'])->name('post-edit');

       //Hide,show
        Route::post('/activecategory/{name?}/{id?}',[AuthorController::class,'postActive'])->name('active-author');

        //Delete
        Route::post('/delete',[AuthorController::class,'destroy'])->name('delete');
        // Route::post('/deleteall/{id?}',[SupplierController::class,'destroyAll'])->name('deleteall');
    }); 

    //SALE REPORT
    Route::get('/report',[ReportController::class,'create'])->name('report');



});

Route::get('/login',[CustomAuthController::class,'logIn'])->name('logIn');
Route::get('/register',[CustomAuthController::class,'register'])->name('register');
Route::post('/new-user',[CustomAuthController::class,'storeNewUser'])->name('storeUser');
Route::get('/homepage', [CustomAuthController::class,'homepage'])->middleware('isLogIn');
Route::get('/homepage', [App\Http\Controllers\user\ProductController::class,'index'])->name('homepage');
Route::post('/checkAcount',[CustomAuthController::class,'checkLogin'])->name('check-login');
Route::get('logout',[CustomAuthController::class,'logOut']);
route::get('/header',function(){
    return view('header');
});

Route::get('/category/{id}', [App\Http\Controllers\user\ProductController::class,'getProductByCategory'])->name('category');
Route::get('/search/{name?}', [App\Http\Controllers\user\ProductController::class,'searchProduct'])->name('search');

route::get('/footer',function(){
    return view('footer');
});
