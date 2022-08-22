<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Admin\AccountService;
use App\Http\Requests\admin\AccountRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    protected $accountService;
    public function __construct(AccountService $accountService)
    {
        $this->accountService=$accountService;
    }
    public function index($name=0,Request $request){
    
        $countActive=$this->accountService->getCount(1);
        $countHide= $this->accountService->getCount(0);
        $countAll= $this->accountService->getCount(-1);
        $count=[$countAll,$countActive,$countHide];
        
        $filters=[];
        if(!empty($name)){
           if($name==='active'){
               $active=1;
            }else if($name=='hide'){ 
                $active=0;
            }
        $filters[]=['users.active','=',$active];
        }
        $list=$this->accountService->getAll($filters);
       
        foreach($list as $item)
        { 
             $totalById=$this->accountService->getTotal($item->id);

             $item->total=$totalById;
        }

        //Search 
        $search_txt=$request->search_txt;
        if(!empty($search_txt)){
            $resultSearch=$this->accountService->getSearch($search_txt,$filters);
        }
        else{
            return view('admin.account.account_list',compact(['list','count']));
        }
        return view('admin.account.account_list',compact(['list','resultSearch','count']));
    }
    public function create()
    {
        return view('admin.account.accountAdd');
    }
    public function postAdd(AccountRequest $request)
    {
       
         $dataInsert=[
            'user_name'=>$request->name,
            'pass'=>$request->pass,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'type'=>$request->user_type,
            'created_at'=>date('y-m-d'),
          
        ];
      
        $tt=$this->accountService->addAccount($dataInsert);
        return redirect()->route('admin.account.index');
    }
    
    // public function postEdit(AccountRequest $request,$id){
    //     $data=[
    //         'user_name'=>$request->name,
    //         'pass'=>$request->pass,
    //         'email'=>$request->email,
    //         'phone'=>$request->phone,
    //         'type'=>$request->user_type
            
    //     ];
    //     $this->accountService->updateAccount($data,$id);
    //     return redirect()->route('admin.Account.index');
    // }
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
            $this->accountService->activeAccount($ids,$id,$active);
        }else{
            redirect()->back();
        }
        return redirect()->back();
    }
    // public function destroy(Request $request){
    //     $id=$request->delete_id;
    //     if(!empty($id)){
    //         $this->accountService->deleteAccount($id);
    //     return redirect()->back();
    //     }
    // }
}
