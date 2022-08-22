<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\NotifyMail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail ;
use App\Http\Controllers\user\NotifyMai;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\DB;

class SendEmailController extends Controller

{
    // public function getdata(Request $request){
         
    //    $title=$request->title;
    //    $content=$request->content;
        
    //     return view('user.emailView',compact(['data']));
    // }
    public function index(Request $request)
    {
         
       return view('admin.notification');
    }
    
    public function sendMail(Request $request)
    {
     $title=$request->title;
     $content=$request->content;
        $emailList=DB::table('users')
        ->select('email')
        ->where('active',1)->get();
       
        // foreach($emailList as $item)
        {
            $emaill='nguyenmoi225@gmail.com';
            // $emaill=$item->email;
           
            Mail::send('user.emailView',compact('title','content'),function($email ) use($emaill){
               $email->subject("Nhà sách IPM thông báo");
               $email->to($emaill,"iuyui");
            });
        }    
        return view('user.sendMail');
    // return redirect()->route('admin.index');
    //   if (Mail::failures()) {
    //        return response()->Fail('Sorry! Please try again latter');
    //   }else{
    //        return response()->success('Great! Successfully send in your mail');
    //      }
    }
}
