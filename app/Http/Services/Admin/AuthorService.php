<?php
namespace App\Http\Services\Admin;
use Exception;
use App\Models\Author;
use Illuminate\Support\Facades\DB;
class AuthorService{
    protected $table='authors';

    public function getAuthor(){    
        $author=DB::table($this->table)
        ->get();
        return $author;
    }
    public function getAll($filters=[]){
        $list=DB::table($this->table)
        ->select('*');
        if(!empty($filters)){
            $list=$list->where($filters);
        }
        $list=$list->paginate(5);
        return $list;
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
    public function getSearch($search_txt,$filters=[]){
        $list=DB::table($this->table)
        ->select('*');
        if(!empty($filters)){
            $list=$list->where($filters);
        }
        $list=$list
        ->where('author_name','like','%'.$search_txt.'%')
        ->get();
        if(empty($list[0])){
            $titleSearch="Không có kết quả phù hợp";
        }else{
            $titleSearch= $list->count();
        }
        $resultSearch=[
            'listSearch'=>$list,
            'titleSearch'=>$titleSearch,
        ];
    return $resultSearch; 
}
public function add($dataInsert){
    try{
        DB::table($this->table)->insert([
            'author_name'=>(string)$dataInsert['author_name'],
            'author_description'=>(string)$dataInsert['author_description'],
            'active'=>'1',
            'created_at'=>$dataInsert['created_at'],
        ]);

        session()->flash('success','Thêm tác giả mới thành công!');
    }catch(Exception $err){ 
        dd($err);
        session()->flash('error','Có lỗi xảy ra. Vui lòng thử lại!');
        return false;
    }  
    return true;
}
 public function updateAuthor($data,$id){
      
        try{
            DB::table($this->table)
            ->where('id','=',$id)
            ->update([
                'author_name'=>(string)$data['author_name'],
                'author_description'=>(string)$data['author_description'],
                'updated_at'=>$data['updated_at'],
            ]);
            session()->flash('success','Cập nhật tác giả thành công!');
        }catch(Exception $err){
            session()->flash('error','Có lỗi xảy ra. Vui lòng thử lại!');
        }
    }
    public function activeSupplier($ids,$id,$active){
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
    public function checkAuthor($author_id){
        try{
            $list=DB::table($this->table)
            ->join('products','products.category_id','authors.id')
            ->where('category_id',$author_id)
            ->get();
            return count($list);
        }catch(Exception $err){
        dd($err);
            // session()->flash('error','Có lỗi xảy ra. Vui lòng thử lại!');
        }
    }
    public function delete($id)
    {
        if($this->checkAuthor($id)>0){
            session()->flash('success','Tác giả này không thể xóa!');
           }
           else{
        try{
            DB::table($this->table)
            ->where('id',$id)
            ->delete();
            session()->flash('success','Xóa tác giả thành công!');
        }catch(Exception $err){
            session()->flash('error','Có lỗi xảy ra. Vui lòng thử lại!');
        }
    }

    }

}