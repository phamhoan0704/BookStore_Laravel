<?php

namespace App\Http\Controllers\Admin;
use App\Http\Services\Admin\SupplierService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\admin\SupplierRequest;
use App\Models\Supplier;

class SupplierController extends Controller
{
    protected $supplierService;
    public function __construct(SupplierService $supplierService)
    {
        // $this->categories=new Category();
        $this->supplierService=$supplierService;

    }
    public function index($name=0,Request $request){
        $countActive=$this->supplierService->getCount(1);
        $countHide= $this->supplierService->getCount(0);
        $countAll= $this->supplierService->getCount(-1);
        $count=[$countAll,$countActive,$countHide];
        $filters=[];
        if(!empty($name)){
           if($name==='active'){
               $active=1;
            }else if($name=='hide'){ 
                $active=0;
            }
        $filters[]=['suppliers.active','=',$active];
        }
        $list=$this->supplierService->getAll($filters);

        //Search 
        $search_txt=$request->search_txt;
        if(!empty($search_txt)){
            $resultSearch=$this->supplierService->getSearch($search_txt,$filters);
        }
        else{
            return view('admin.supplier.supplier_list',compact(['list','count']));
        }
        return view('admin.supplier.supplier_list',compact(['list','resultSearch','count']));
    }
    public function create()
    {
        return view('admin.supplier.supplierAdd');
    }
    public function postAdd(SupplierRequest $request)
    {
       
         $dataInsert=[
            'supplier_name'=>$request->supplier_name,
            'supplier_phone'=>$request->supplier_phone,
            'supplier_address'=>$request->supplier_address,
            'created_at'=>date('y-m-d'),
        ];
        $this->supplierService->add($dataInsert);
        return redirect()->route('admin.supplier.index');
    }
    public function getEdit(Supplier $id){
        $detail=$id;
        return view('admin.supplier.supplierEdit',compact(['detail']));
    }
    public function postEdit(SupplierRequest $request,$id){
        $data=[
            'supplier_name'=>$request->supplier_name,
            'supplier_phone'=>$request->supplier_phone,
            'supplier_address'=>$request->supplier_address,
            'updated_at'=>date('y-m-d'),
        ];
        $this->supplierService->updateSupplier($data,$id);
        return redirect()->route('admin.supplier.index');
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
            $this->supplierService->activeSupplier($ids,$id,$active);
        }else{
            redirect()->back();
        }
        return redirect()->back();
    }
    public function destroy(Request $request){
        $id=$request->delete_id;
        if(!empty($id)){
            $this->supplierService->delete($id);
        return redirect()->back();
        }
    }
}
