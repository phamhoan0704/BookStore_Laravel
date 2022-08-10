<?php

namespace App\Http\Controllers;

use App\Http\Requests\checkLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\checkRegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
    //
    public function logIn()
    {
        return view('user.login');
    }
    public function checkLogin(Request $request)
    {
        $request->validate(
            [
            'name' => 'required',
            'password' => 'required|min:5'
    
        ], 
        [
            'name.required' => 'Tên đăng nhập không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu tối thiểu phải có :min kí tự'

        ]);
        $user=DB::table('users')->where('user_name',$request->input('name'))->first();
        if(isset($user)){
            
            if(Hash::check($request->input('password'),$user->user_password))
            {
                $request->session()->put('loginId',$user->id);
                return redirect('/user/home');
            }
            else{
                return back()->with('fail2','Mật khẩu không chính xác!');
            }

        }
        else{
            return back()->with('fail1','Tên đăng nhập không tồn tại');
        }
    }
    
    public function register()
    {
        return view("user.register");
    }
    public function storeNewUser(Request $request)
    {


        $request->validate(
            [
                'name' => 'required|unique:users',
                'password' => 'required|min:5',
                'email' => 'required|email|unique:users',
                'phone' => 'required|min:9|max:13'

            ],
            [
                'name.required' => 'Tên đăng nhập không được để trống',
                // 'name.min' => 'Tên đăng nhập tối thiểu phải có :min kí tự',
                // 'name.max' => 'Tên đăng nhập tối đa :max kí tự',
                // 'name.regex' => 'Tên đăng nhập không hợp lệ',
                'name.unique'=>'Tên đăng nhập đã tồn tại',
                'password.required' => 'Mật khẩu không được để trống',
                'password.min' => 'Mật khẩu tối thiểu phải có :min kí tự',
                'password.max' => 'Mật khẩu tối đa :max kí tự',
                //'password.regex' => 'Mật khẩu không hợp lệ',
                'password.confirmed' => 'Mật khẩu không trùng khớp',
                'email.required' => 'Email không được bỏ trống',
                'email.email' => 'Email không hợp lệ',
                'email.unique'=>"Email này đã tồn tại",
                'phone.required' => 'Số điện thoại không được bỏ trống',
                // 'phone.number'=>'Số điện thoại không hợp lệ',
                'phone.max' => 'Số điện thoại không hợp lệ',
                'phone.min' => 'Số điện thoại không hợp lệ'
            ]
        );


        $user = new User();
        $user->user_name = $request->input('name');
        $user->email = $request->input('email');
        $user->user_password = Hash::make($request->input('password'));
        $user->user_phone = $request->input('phone');
        $user->user_type = 1;
        $user->active=1;
        $res = $user->save();
        if ($res) {
            return back()->with('success', 'Tạo tài khoản thành công');
        } else {
            return back()->with('fail', 'Tài khoản không hợp lệ');
        }
        
    }
    public function homepage(){
        $data=array();
        if(Session::has('loginId')){
            $data=DB::table('users')->where('id','=',Session::get('loginId'))->first();
        }
        return view('user.home',compact('data'));
       
    }
    public function logOut(){
        if(Session::has('loginId')){
            Session::pull('loginId');
            redirect('noLogin');
        }
    }
    
}
