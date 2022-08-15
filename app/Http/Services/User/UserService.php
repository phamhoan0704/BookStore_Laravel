<?php
namespace App\Http\Services\User;
use Exception;
use App\Models\Author;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use app\Models\Cart;
class UserService{
    protected $table='users';

   public function getUser(){
        $user=DB::table($this->table)->where('id',Session::get('loginId'))->first();
        return $user;
  
   }

}
?>