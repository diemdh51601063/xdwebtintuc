<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function getlogin(){
      if(Auth::check())
      {
        return redirect('admin/tin/danhsach.html');
      }
      else
    	return view('admin/user/login');
    }

    public function postlogin(Request $request){
       $this->validate($request,
            [
                'tentaikhoan'=>'required|min:1|max:255|email|regex:/^[a-zA-Z0-9@.\s]+$/',
                'matkhau'=>'required|min:1|max:255|regex:/^[a-zA-Z0-9\s]+$/'
            ],
            [   
                'tentaikhoan.required'=>'Chưa điền tài khoảng.',
                'tentaikhoan.min'=>'Sai tài khoản.',
                'tentaikhoan.max'=>'Sai tài khoản.',
                'tentaikhoan.email'=>'Không đúng định dạng email.',
                'tentaikhoan.regex'=>'Có chứa các kí tự đặc biệt không cho phép.',
                'matkhau.required'=>'Chưa điền mật khẩu.',
                'matkhau.min'=>'Sai mật khẩu.',
                'matkhau.max'=>'Sai mật khẩu.',
                'matkhau.regex'=>'Gồm a-zA-Z0-9.',

            ]

        );
 
     
       if(Auth::attempt(['email'=>$request->tentaikhoan,'password'=>$request->matkhau]))
		{
				return redirect('admin/tin/danhsach.html');

		}
		else
       {
       	return redirect('admin/login.html')->with('thongbao','Đăng nhập không thành công.');
       }

    }

    public function getlogout(){
		Auth::logout();
    	return redirect('admin/login.html');
    }
}
