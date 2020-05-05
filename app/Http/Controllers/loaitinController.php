<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\loaitin;
use App\nhomtin;
class loaitinController extends Controller
{
  public function getdanhsach(){
    	$loaitin=loaitin::all();
    	return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }

     public function getthem(){
    	$nhomtin=nhomtin::all();
    	return view('admin.loaitin.them',['nhomtin'=>$nhomtin]);
    }

    public function postthem(Request $request){
       $this->validate($request,
            [
                'ten'=>'required|min:1|max:255|unique:loaitin,tenloaitin|regex:/[a-zA-Z]+/',
               
            ],
            [   
                'ten.unique'=>'Đã tồn tại tên loại tin.',
                'ten.required'=>'Bạn chưa nhập tên loại tin.',
                'ten.min'=>'Tên loại tin phải có độ dài từ 1 cho đến 255 ký tự.',
                'ten.max'=>'Tên loại tin phải có độ dài từ 1 cho đến 255 ký tự.',
                'ten.regex'=>'Phải chứa a-zA-Z.',
                
            ]

        );
  	
        $loaitin=new  loaitin;
        $loaitin->id=$request->id;
         $loaitin->loaitinseo=str_slug($request->ten);
        $loaitin->tenloaitin=$request->ten;

        $loaitin->id_nhomtin=$request->nhomtin;
        $loaitin->save();

        return redirect('admin/loaitin/them.html')->with('thongbao','Thêm thành công.');

    }

     public function getsua($id_loaitin){
      
        $loaitin=loaitin::find($id_loaitin);
        if($loaitin==null)
          return redirect('admin/loaitin/danhsach.html')->with('thongbao','Không tồn tại loại tin.');
        
        $nhomtin=nhomtin::all();
      
        return view('admin.loaitin.sua',['loaitin'=>$loaitin,'nhomtin'=>$nhomtin]);
      
    }

    public function postsua(Request $request,$id_loaitin){

            $loaitin=loaitin::find($id_loaitin);

          $this->validate($request,
            [

            
             'ten'=>'required|min:1|max:255|unique:loaitin,tenloaitin,'.$id_loaitin.',id|regex:/[a-zA-Z]+/'
                
            ],
            [   
                'ten.regex'=>'Phải chứa a-zA-Z.',
                'ten.unique'=>'Đã tồn tại tên loại tin.',
                'ten.required'=>'Bạn chưa nhập tên loại tin.',
                'ten.min'=>'Tên loại tin phải có độ dài từ 1 cho đến 255 ký tự.',
                'ten.max'=>'Tên loại tin phải có độ dài từ 1 cho đến 255 ký tự.',
                
            ]

        );

     
        $loaitin->tenloaitin=$request->ten;
        $loaitin->trangthai=$request->radios;
            $loaitin->loaitinseo=str_slug($request->ten);
        $loaitin->save();
         return redirect('admin/loaitin/sua-'.$id_loaitin.'.html')->with('thongbao','Sửa thành công.');

    }

    public function getxoa($id_loaitin){
         $loaitin=loaitin::find($id_loaitin);

          if(count($loaitin->tin)==0)
           {
         $loaitin->delete();
         return redirect('admin/loaitin/danhsach.html')->with('thongbao','Xóa thành công.');
            }
            else
            {
                  return redirect('admin/loaitin/danhsach.html')->with('thongbao','Xóa không thành công.'); 
            }

    }


}
