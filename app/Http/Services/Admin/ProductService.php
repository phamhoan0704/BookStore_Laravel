<?php
namespace App\Http\Services\Admin;

use App\Models\Product;
use Exception;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ProductService{
    protected $table='products';
    public function getAllCategories($filters=[]){
        $category=DB::table($this->table)
        ->select('*');
        if(!empty($filters)){
            $category=$category->where($filters);
        }
        $category=$category->paginate(5);
        // dd($category);
        return $category;
    }
    public function getCount($x){
        $count=DB::table($this->table);
        if($x==1){
           $count=$count ->where('active','1');
        }elseif($x==0){
            $count=$count ->where('active','0');
        }
        $count=$count ->count();            
        return $count;
    }

    public function getSearchProduct($search_txt,$filters=[]){
        $category=DB::table($this->table)
        ->select('*');
        if(!empty($filters)){
            $category=$category->where($filters);
        }
        $category=$category
        ->where('product_name','like','%'.$search_txt.'%')
        ->get();
        if(empty($category[0])){
            $titleSearch="Không có kết quả phù hợp";
        }else{
            $titleSearch= $category->count();
        }
        $resultSearch=[
            'listSearch'=>$category,
            'titleSearch'=>$titleSearch,
        ];

    return $resultSearch; 
    }

    public function addProduct($dataInsert){
    

        try{
            DB::table($this->table)->insert([
                'product_name'=>(string)$dataInsert['product_name'],
                'product_year'=>Carbon::parse($dataInsert['product_year'])->format('Y-m-d H:i:s'),
                'product_price'=>(double)$dataInsert['product_price'],
                'product_price_pre'=>(double)$dataInsert['product_price_pre'],
                'product_quantity'=>(double)$dataInsert['product_quantity'],
                'product_image'=>(string)$dataInsert['product_image'],
                'product_detail'=>(string)$dataInsert['product_detail'],
                'category_id'=>$dataInsert['category_id'],
                'author_id'=>$dataInsert['author_id'],
                'supplier_id'=>$dataInsert['supplier_id'],
                'created_at'=>$dataInsert['created_at'],
                'active'=>'1',
            ]);
        
          
         session()->flash('success','Tạo sản phẩm mới thành công!');
        }catch(Exception $err){
            dd($err);
            session()->flash('error',$err);
            return false;
        }  
        return true;
    }
    public function updateProduct($data,$id){
      
        try{
            DB::table($this->table)
            ->where('id','=',$id)
            ->update([
                'product_name'=>(string)$data['product_name'],
                'product_year'=>Carbon::parse($data['product_year'])->format('Y-m-d H:i:s'),
                'product_price'=>(double)$data['product_price'],
                'product_price_pre'=>(double)$data['product_price_pre'],
                'product_quantity'=>(double)$data['product_quantity'],
                'product_image'=>(string)$data['product_image'],
                'product_detail'=>(string)$data['product_detail'],
                'category_id'=>$data['category_id'],
                'author_id'=>$data['author_id'],
                'supplier_id'=>$data['supplier_id'],
                'updated_at'=>$data['updated_at'],
            ]);
            session()->flash('success','Cập nhật sản phẩm thành công!');
        }catch(Exception $err){
            session()->flash('error','Có lỗi xảy ra. Vui lòng thử lại!');
        }
    }
    public function activeProduct($ids,$id,$active){
        $product=DB::table($this->table);
        if(!empty($ids)){
            $product->whereIn('id',$ids);
        }
        if(!empty($id)){
            $product->where('id',$id); 
        }
        $product->update([
            "active"=>$active,
        ]);
        
    }
    public function deleteProduct($id)
    {
        try{
            DB::table($this->table)
            ->where('id',$id)
            ->delete();
            session()->flash('success','Xóa sản phẩm thành công!');
        }catch(Exception $err){
            session()->flash('error','Có lỗi xảy ra. Vui lòng thử lại!');
        }

    }





    // USER
    public function getNewProduct($filters=[]){
        $category=DB::table($this->table)
        ->select('*')
        ->where('active','1')
        ->orderByDesc('product_year')
        ->get();
        // dd($category);
        return $category;
    }

    public function getProductByCategory($category_id,$filters=[]){
        if($category_id==0)
        {
            $category_list=DB::table($this->table)
            ->select('*')
            ->where('active','1')
            ->orderByDesc('product_year');
        } else {
            $category_list=DB::table($this->table)
            ->select('*')
            ->where('active','1')
            ->where('category_id',$category_id)
            ->orderByDesc('product_year');
        }
        $category_list=$category_list->paginate(16);
        // dd($category_list);
        return $category_list;
    }

    public function searchProduct($search){
        $search_list=DB::table($this->table)
        ->select('*')
        ->where('product_name','like','%'.$search.'%');
        $search_list=$search_list->paginate(16);
        return $search_list; 
    }
   

}