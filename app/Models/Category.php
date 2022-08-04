<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    // protected $table='categories';
    // public function getAllCategories($filters=[]){
    //     $category=DB::table($this->table)
    //     ->select('*');

    //     if(!empty($filters)){
    //         $category=$category->where($filters);
    //     }
    //     $category=$category->paginate(5);
    //     return $category;
    // }
    // public function addcategory($dataInsert){
    //    DB::table($this->table)->insert([
    //         'category_name'=>$dataInsert['category_name'],
    //         'active'=>'1',
    //         'created_at'=>$dataInsert['created_at'],
    //     ]);

    // }
    // public function getDetailCategory($id){
    //     $category=DB::table($this->table)
    //     ->select('*')
    //     ->where('id','=',$id)
    //     ->get();
    //     return $category;
    // }

    // public function updateCategory($data,$id){
    //     $category=DB::table($this->table)
    //     ->where('id','=',$id)
    //     ->update([
    //         'category_name'=>$data['category_name'],
    //         'updated_at'=>$data['updated_at'],
    //     ]);
    //     return $category;
    // }
    // public function getSearchCategory($search_txt,$filters=[]){
    //     $category=DB::table($this->table)
    //     ->select('*');

    //     if(!empty($filters)){
    //         $category=$category->where($filters);
    //     }
    //     $category=$category
    //     ->where('category_name','like','%'.$search_txt.'%')
    //     ->get();
    //     return $category;

    // }
    // public function deleteCategory($category_id)
    // {
    //     DB::table($this->table)
    //     ->where('id',$category_id)
    //     ->delete();
    // }
    // public function deleteCategory2($category_id)
    // {
    //     DB::table($this->table)
    //     ->whereIn('id',$category_id)
    //     ->delete();
        
    // }
}
