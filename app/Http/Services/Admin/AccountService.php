<?php
namespace App\Http\Services\Admin;
use App\Models\User;
use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountService{
    protected $table='users';
      
    public function getTotal($user_id)
     {
        $totalById= array();
        $totalById=Order::select("user_id",DB::raw("SUM(total_money) as total"))
        ->groupby ('user_id')
        ->where('user_id',$user_id)->get();
        if(empty($totalById[0]->total))
        $tt=0;
        else
        $tt=$totalById[0]->total;

       return $tt;
       
     }
    public function getAll($filters=[]){
        
        $account=DB::table($this->table)
        // ->join('orders','orders.user_id','users.id')
        // ->select('*')->sum('total_money')
        // ->groupby('*')
        ->where('user_type',1);
        if(!empty($filters)){
            $account=$account->where($filters);
        }
        $account=$account->paginate(5);
        return $account;
    }
    
    public function getAccount(){    
        $account=DB::table($this->table)
   
        ->get();
        return $account;
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
            $account=DB::table($this->table)
            ->select('*');
            if(!empty($filters)){
                $account=$account->where($filters);
            }
            $account=$account
            ->where('user_name','like','%'.$search_txt.'%')
            ->get();
            if(empty($account[0])){
                $titleSearch="Không có kết quả phù hợp";
            }else{
                $titleSearch =$account->count();
            }
            $resultSearch=[
                'listSearch'=>$account,
                'titleSearch'=>$titleSearch,
            ];
        return $resultSearch; 
    }

    public function addAccount($dataInsert){
        try{
            DB::table($this->table)->insert([
                'user_name'=>$dataInsert['user_name'],
                'active'=>'1',
                'created_at'=>$dataInsert['created_at'],
                'email' => $dataInsert['email'],
                'user_password' => Hash::make($dataInsert['pass']),
                'user_phone' =>$dataInsert['phone'],
                'user_type' => $dataInsert['type'],
                'active'=>1,
                'created_at'=>$dataInsert['created_at'],
            ]);
            session()->flash('success','Tạo tài khoản thành công!');
        }catch(Exception $err){
            session()->flash('error','Có lỗi xảy ra. Vui lòng thử lại!');
            
        }  
    }


    public function activeAccount($ids,$id,$active){
        $account=DB::table($this->table);
        if(!empty($ids)){
            $account->whereIn('id',$ids);
        }
        if(!empty($id)){
            $account->where('id',$id); 
        }
        $account->update([
            "active"=>$active,
        ]);
        
        //return $account;
    }




    public function getAccountList($filters=[]){
        $account=DB::table($this->table)
        ->select('*')
        ->where('active','1')
        ->get();
        return $account;
}
}