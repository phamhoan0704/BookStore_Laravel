<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Http\Services\Admin\AuthorService;
use App\Http\Services\Admin\ProductService;
use Illuminate\Http\Request;
use App\Http\Services\Admin\CategoryService;
use App\Http\Services\Admin\SupplierService;
use App\Http\Requests\admin\CategoryRequest;
use App\Http\Requests\admin\ProductRequest;

class ProductController extends Controller
{
    
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService=$productService;
    }
    public function index($name=0,Request $request){

        $countActive= $this->productService->getCount(1);
        $countHide= $this->productService->getCount(0);
        $countAll= $this->productService->getCount(-1);
        $count=[$countAll,$countActive,$countHide];
        $filters=[];
        if(!empty($name)){
           if($name==='active'){
               $active=1;
            }else if($name=='hide'){ 
                $active=0;
            }
        $filters[]=['products.active','=',$active];
        }
        $productList=$this->productService->getAllCategories($filters);
        //Search  
        $search_txt=$request->search_txt;
        if(!empty($search_txt)){
            $resultSearch=$this->productService->getSearchProduct($search_txt,$filters);
        }
        else{
            return view('admin.product.product_list',compact(['productList','count']));
        }
        return view('admin.product.product_list',compact(['productList','resultSearch','count']));
    }
    
    public function create(){
        $cat=new CategoryService();
        $category=$cat->getCategory();
        $sup=new SupplierService();
        $supplier=$sup->getSupplier();
        $aut=new AuthorService();
        $author=$aut->getAuthor();
        return view('admin.product.productAdd',compact (['category','author','supplier']));
    }

    public function postAdd(ProductRequest $request){
      
        $image = $request->file('product_image')->getClientOriginalName();
        $file= $request->file('product_image');
        $file-> move(public_path('template/image/product_image'), $image);

         $dataInsert=[
            'product_name'=>$request->product_name,
            'product_year'=>$request->product_year,
            'product_price'=>$request->product_price,
            'product_price_pre'=>$request->product_price_pre,
            'product_image'=>$request->file('product_image')->getClientOriginalName(),
            'product_quantity'=>$request->product_quantity,
            'product_detail'=>$request->product_detail,
            'category_id'=>$request->category,
            'author_id'=>$request->author_id,
            'supplier_id'=>$request->supplier,
            'created_at'=>date('y-m-d'),
        ];
        $this->productService->addProduct($dataInsert);
        return redirect()->route('admin.product.index');
    }

    public function getEdit(Product $id){
        $productDetail=$id;
        $cat=new CategoryService();
        $category=$cat->getCategory();
        $sup=new SupplierService();
        $supplier=$sup->getSupplier();
        $aut=new AuthorService();
        $author=$aut->getAuthor();
        return view('admin.product.productEdit',compact(['productDetail','category','author','supplier']));
    }

    public function postEdit(ProductRequest $request,$id){
        $image = $request->file('product_image')->getClientOriginalName();
        $file= $request->file('product_image');
        $file-> move(public_path('template/image/product_image'), $image);

         $data=[
            'product_name'=>$request->product_name,
            'product_year'=>$request->product_year,
            'product_price'=>$request->product_price,
            'product_price_pre'=>$request->product_price_pre,
            'product_image'=>$request->file('product_image')->getClientOriginalName(),
            'product_quantity'=>$request->product_quantity,
            'product_detail'=>$request->product_detail,
            'category_id'=>$request->category,
            'author_id'=>$request->author_id,
            'supplier_id'=>$request->supplier,
            'updated_at'=>date('y-m-d'),
        ];
 
        $this->productService->updateProduct($data,$id);
        return redirect()->route('admin.product.index');
    }

    public function postActive(Request $request){
        $ids=$request->ids;  
        $id=$request->id;
        $name=$request->name;
        if($name=='show'){
            $active=1;
        }
        if($name=='hidden'){
            $active=0;
        }
        if(!empty($ids)||!empty($id)){
            $this->productService->activeProduct($ids,$id,$active);
        }else{
            redirect()->back();
        }
        return redirect()->back();
    }
    public function destroy(Request $request){
        $id=$request->delete_id;
        if(!empty($id)){
            $this->productService->deleteProduct($id);
        return redirect()->back();
        }
    }
}
