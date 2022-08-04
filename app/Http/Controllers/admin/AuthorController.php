<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Admin\AuthorService;
use App\Http\Requests\admin\AuthorRequest;
use App\Models\Author;

class AuthorController extends Controller
{
    protected $authorService;
    public function __construct(AuthorService $authorService)
    {
        $this->authorService=$authorService;
    }
    public function index($name=0,Request $request){
    
        $countActive=$this->authorService->getCount(1);
        $countHide= $this->authorService->getCount(0);
        $countAll= $this->authorService->getCount(-1);
        $count=[$countAll,$countActive,$countHide];
        
        $filters=[];
        if(!empty($name)){
           if($name==='active'){
               $active=1;
            }else if($name=='hide'){ 
                $active=0;
            }
        $filters[]=['authors.active','=',$active];
        }
        $list=$this->authorService->getAll($filters);

        //Search 
        $search_txt=$request->search_txt;
        if(!empty($search_txt)){
            $resultSearch=$this->authorService->getSearch($search_txt,$filters);
        }
        else{
            return view('admin.author.author_list',compact(['list','count']));
        }
        return view('admin.author.author_list',compact(['list','resultSearch','count']));
    }
    public function create()
    {
        return view('admin.author.authorAdd');
    }
    public function postAdd(AuthorRequest $request)
    {
       
         $dataInsert=[
            'author_name'=>$request->author_name,
            'author_description'=>$request->detail, 
            'created_at'=>date('y-m-d'),
        ];
        $this->authorService->add($dataInsert);
        return redirect()->route('admin.author.index');
    }
    public function getEdit(Author $id){
        $detail=$id;
        return view('admin.author.authorEdit',compact(['detail']));
    }
    public function postEdit(AuthorRequest $request,$id){
        $data=[
            'author_name'=>$request->author_name,
            'author_description'=>$request->detail, 
            'updated_at'=>date('y-m-d'),
        ];
        $this->authorService->updateAuthor($data,$id);
        return redirect()->route('admin.author.index');
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
            $this->authorService->activeSupplier($ids,$id,$active);
        }else{
            redirect()->back();
        }
        return redirect()->back();
    }
    public function destroy(Request $request){
        $id=$request->delete_id;
        if(!empty($id)){
            $this->authorService->delete($id);
        return redirect()->back();
        }
    }
}
