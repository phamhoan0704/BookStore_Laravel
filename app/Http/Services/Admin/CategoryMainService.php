<?php
namespace App\Http\Services\Admin;

use App\Models\Category;
use Exception;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;
class CategoryMainService{
    protected $table='category_main';
   



    public function getCategoryMainList($filters=[]){
        $category_main=DB::table($this->table)
        ->select('*')
        ->get();
        return $category_main;
}
}