<?php
namespace App\Http\Services\Admin;

use App\Models\Category;
use Exception;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;
class CategoryService{
    protected $table='categories';
    // public function getAll($name,$request){
    //     if(!empty($name)){
    //         if($name==='active'){
    //              $categoryList=$this->categories->getActiveCategories();
    //          }else if($name=='hide'){ 
    //              $categoryList=$this->categories->getHideCategories();
    //          }else if($name=='all'){
    //              $categoryList=$this->categories->getAllCategories(); 
    //          }
    //      }else{
    //          $categoryList=$this->categories->getAllCategories();
    //      }
    //      return $categoryList;

    // }
    // public function search($request){
    //     $search_txt=$request->search_txt;
    //     if(!empty($search_txt)){
    //         $categorySearch=$this->categories->getSearchCategory($search_txt);
    //         if(empty($categorySearch[0])){
    //             $titleSearch="Không có kết quả phù hợp";
    //             return $titleSearch;
    //         }else{
    //             $categorySearch_Size=$categorySearch->count();
    //             $titleSearch=$categorySearch_Size;
    //             $data=[
                    
    //             ]
    //             return 
    //         }
    //     }   

      
    // }
    
    public function getAllCategories($filters=[]){
        $category=DB::table($this->table)
        ->select('*');
        if(!empty($filters)){
            $category=$category->where($filters);
        }
        $category=$category->paginate(5);
        return $category;
    }
    
    public function getCategory(){    
        $category=DB::table($this->table)
   
        ->get();
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

    public function getSearchCategory($search_txt,$filters=[]){
            $category=DB::table($this->table)
            ->select('*');
            if(!empty($filters)){
                $category=$category->where($filters);
            }
            $category=$category
            ->where('category_name','like','%'.$search_txt.'%')
            ->get();
            if(empty($category[0])){
                $titleSearch="Không có kết quả phù hợp";
            }else{
                $titleSearch= $category->count();
            }
            $resultSearch=[
                'categorySearch'=>$category,
                'titleSearch'=>$titleSearch,
            ];
        return $resultSearch; 
    }

    public function addcategory($dataInsert){
        try{
            DB::table($this->table)->insert([
                'category_name'=>$dataInsert['category_name'],
                'active'=>'1',
                'created_at'=>$dataInsert['created_at'],
            ]);

            session()->flash('success','Tạo danh mục mới thành công!');
        }catch(Exception $err){
            session()->flash('error','Có lỗi xảy ra. Vui lòng thử lại!');
            return false;
        }  
        return true;
    }
//     public function getDetailCategory($id){
//         // $categoryDetail=[];
//         if(!empty($id)){
//           // dd("ccc");
//             try{
               
//                 $categoryDetail=DB::table($this->table)
//                 ->select('*')
//                 ->where('id','=',$id)
//                 ->get();
            
//             }catch(Exception $err){
//                 dd("rrr");
//                 session()->flash('error','Có lỗi xảy ra. Vui lòng thử lại!');
//             }
//             if(!empty($categoryDetail[0])){
//                 $categoryDetail=$categoryDetail[0];
//                 return $categoryDetail;
//             }else{
//                 return false;
//             }
//         }else{
//             return false;
//         }

// }

    public function updateCategory($data,$id){
        try{
            $category=DB::table($this->table)
            ->where('id','=',$id)
            ->update([
                'category_name'=>$data['category_name'],
                'updated_at'=>$data['updated_at'],
            ]);
            session()->flash('success','Cập nhật danh mục thành công!');
            return $category;
        }catch(Exception $err){
            session()->flash('error','Có lỗi xảy ra. Vui lòng thử lại!');
        }
    }

    public function deleteCategory($category_id)
    {
        try{
            DB::table($this->table)
            ->where('id',$category_id)
            ->delete();
            session()->flash('success','Xóa danh mục thành công!');
        }catch(Exception $err){
            session()->flash('error','Có lỗi xảy ra. Vui lòng thử lại!');
        }

    }

    public function activeCategory($ids,$id,$active){
        $category=DB::table($this->table);
        if(!empty($ids)){
            $category->whereIn('id',$ids);
        }
        if(!empty($id)){
            $category->where('id',$id); 
        }
        $category->update([
            "active"=>$active,
        ]);
        
        //return $category;
    }




    public function getCategoryList($filters=[]){
        $category=DB::table($this->table)
        ->select('*')
        ->where('active','1')
        ->get();
        return $category;
}
}