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
use App\Http\Services\User\UserService;
use Exception;

class CustomAuthController extends Controller
{
    protected $categoryService;
    protected $cartService;
    protected $userService;

    public function __construct( CategoryService $categoryService, CartService $cartService,UserService $userService)
    {
        $this->categoryService=$categoryService;
        $this->cartService=$cartService;
        $this->userService=$userService;
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
                if($user->active==1){
                    $request->session()->put('loginId',$user->id);
                    return redirect('user/home');
                }
                else{
                    return back()->with('fail3','Tài khoản của bạn đã bị khóa!');
                }
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
                'name.unique'=>'Tên đăng nhập đã tồn tại',
                // 'name.min' => 'Tên đăng nhập tối thiểu phải có :min kí tự',
                // 'name.max' => 'Tên đăng nhập tối đa :max kí tự',
                // 'name.regex' => 'Tên đăng nhập không hợp lệ',
               
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
        return redirect()->route('user.infor');

    }
    public function newPass()
    
    {
        
        $categoryList=$this->categoryService->getCategoryList();
        $data=$this->userService->getUser();
        $cartList=$this->cartService ->getCartList();
        return view('user.changepassword',compact(['categoryList','data','cartList']));
    }
    public function changePass(Request $request){
       
        $data=$this->userService->getUser();
       
        $user=new User();
        $request->validate(
            [
                
                'pass' => 'required|min:5 ',
            ],
            [
                'pass.required' => 'Mật khẩu không được để trống',
                'pass.min'=>'Mật khẩu tối thiểu 5 kí tự',
                'pass.confirm'=>'Mật khẩu không trùng khớp',
            ]
            );
        if(Hash::check($request->input('pass'),$data->user_password))
         {
            if($request->input('newpass')!=$request->input('newpassconfirm'))
            {
                
           
                return back()->with('fail2','Mật khẩu mới không trùng khớp!');
            }
            else{
                $password=Hash::make($request->input('newpass'));
               
                DB::table('users')->where('id',$data->id)->update(['user_password'=>$password]);
                return redirect()->route('user.changepass')->with('success','Đổi mật khẩu thành công !');

            }
           
         }
         else
         return back()->with('fail1',"Mật khẩu không đúng!");




    }

    public function logOut(){
        $cartList=$this->cartService->getCartList();
        if(Session::has('loginId')){
            Session::pull('loginId');
        }

         return redirect('user/home');

    }
    
}
