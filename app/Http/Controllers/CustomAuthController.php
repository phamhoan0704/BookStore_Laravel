<?php

namespace App\Http\Controllers;

use App\Http\Requests\checkLoginRequest;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Requests\checkRegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Illuminate\Support\Facades\Session;
use App\Http\Services\User\CartService;

use App\Http\Services\Admin\CategoryService;
use Exception;

class CustomAuthController extends Controller
{
    protected $categoryService;
    protected $cartService;

    public function __construct( CategoryService $categoryService, CartService $cartService)
    {
        $this->categoryService=$categoryService;
        $this->cartService=$cartService;
    }
    //
    public function logIn()
    {
        $categoryList=$this->categoryService->getCategoryList();
        $cartList=$this->cartService->getCartList();

        return view('user.login',compact(['categoryList','cartList']));
    }
    public function store(Request $request){
        // dd($requests->input());
        $credentials = [
            'user_name' => $request['name'],
            'user_password' => $request['password'],
        ];
    
       if(Auth::attempt([
           'user_name'=>$credentials['user_name'],
           'password'=>$credentials['user_password']],
        ))  {
           
            return redirect()->route('user.homepage');
        }else{
            dd("ffhjkk");
        }
    
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
               


                return redirect('user/home');


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
        $cartList=$this->cartService->getCartList();
        $categoryList=$this->categoryService->getCategoryList();

        return view("user.register",compact(['categoryList','cartList']));
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
         ///tạo cart_id
         $cart=new Cart();
         $cart->user_id=$user->id;
         $res = $cart->save();
          
        if ($res) {
            return redirect('user/login')->with('success', 'Tạo tài khoản thành công');
        } else {
            return back()->with('fail', 'Tài khoản không hợp lệ');
        }
       
      
        
    }
    
   
    public function profile(Request $request){
        $categoryList=$this->categoryService->getCategoryList();
        $cartList=$this->cartService->getCartList();
        $data=array();
       
        if(Session::has('loginId')){

            $data=DB::table('users')->where('id','=',Session::get('loginId'))->first();

        }
        return view('user.user_infor',compact(['categoryList','data','cartList'])); 

       
    }
    public function updateProfile(Request $request)
    {
        $id=session()->get('loginId');
        $user=User::find($id);
        $user->name=$request->input('fullname');
        $user->user_phone=$request->input('phone');
        $user->email=$request->input('email');
        $user->update();
        return redirect()->route('check.infor');

    }


    public function logOut(){
        if(Session::has('loginId')){
            Session::pull('loginId');
        }

         return redirect('user/home');

    }
    
}
