<?php
namespace App\Http\Services\Admin;
use Exception;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
class SupplierService{
    protected $table='suppliers';

    public function getSupplier(){    
        $category=DB::table($this->table)
        ->get();
        return $category;
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
        ->where('supplier_name','like','%'.$search_txt.'%')
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
            'supplier_name'=>(string)$dataInsert['supplier_name'],
            'supplier_phone'=>(int)$dataInsert['supplier_phone'],
            'supplier_address'=>(string)$dataInsert['supplier_address'],
            'active'=>'1',
            'created_at'=>$dataInsert['created_at'],
        ]);

        session()->flash('success','Thêm nhà cung cấp mới thành công!');
    }catch(Exception $err){ 
        dd($err);
        session()->flash('error','Có lỗi xảy ra. Vui lòng thử lại!');
        return false;
    }  
    return true;
}
 public function updateSupplier($data,$id){
      
        try{
            DB::table($this->table)
            ->where('id','=',$id)
            ->update([
                'supplier_name'=>(string)$data['supplier_name'],
                'supplier_phone'=>(int)$data['supplier_phone'],
                'supplier_address'=>(string)$data['supplier_address'],
                'updated_at'=>$data['updated_at'],
            ]);
            session()->flash('success','Cập nhật nhà cung cấp thành công!');
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
    public function delete($id)
    {
        try{
            DB::table($this->table)
            ->where('id',$id)
            ->delete();
            session()->flash('success','Xóa nhà cung cấp thành công!');
        }catch(Exception $err){
            session()->flash('error','Có lỗi xảy ra. Vui lòng thử lại!');
        }

    }
}