<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\nhomtin;


class nhomtinController extends Controller
{
    public function demo()
    {
    	$a=nhomtin::find(1);

    	echo json_encode($a);

    	echo json_encode($a->loaitin);
    	foreach ($a->loaitin as $value) {
    		echo $value->id;
    		echo json_encode($value);
    	}
    	
    }
     public function demo1()
    {
       
        return view('admin/tin/them');
    }

    public function getdanhsach(){

        $nhomtin=nhomtin::all();
        return view('admin.nhomtin.danhsach',['nhomtin'=>$nhomtin]);
        
    }

    public function getthem(){

        return view('admin.nhomtin.them');
    }

    public function postthem(Request $request){
       $this->validate($request,
            [
                'ten'=>'required|min:1|max:255|unique:nhomtin,tennhomtin|regex:/[a-zA-Z]+/'
            ],
            [   
                'ten.unique'=>'Đã tồn tại tên nhóm tin.',
                'ten.required'=>'Bạn chưa nhập tên nhóm tin.',
                'ten.min'=>'Tên nhóm tin phải có độ dài từ 1 - 255 ký tự.',
                'ten.max'=>'Tên nhóm tin phải có độ dài từ 1 - 255 ký tự.',
                'ten.regex'=>'Tên nhóm tin phải có chữ.',
            ]

        );
 
        $nhomtin=new  nhomtin;
        $nhomtin->tennhomtin=$request->ten;
        $nhomtin->nhomtinseo = str_slug($request->ten);
        $nhomtin->save();

        return redirect('admin/nhomtin/them.html')->with('thongbao','Thêm thành công');

    }

     public function getsua($id_nhomtin){
      
        $nhomtin=nhomtin::find($id_nhomtin);
        if($nhomtin==null)
          return redirect('admin/nhomtin/danhsach.html')->with('thongbao','Không tồn tại nhóm tin.');
        return view('admin.nhomtin.sua',['nhomtin'=>$nhomtin]);
        
    }

    public function postsua(Request $request,$id_nhomtin){

            $nhomtin=nhomtin::find($id_nhomtin);

         $this->validate($request,
            [
                'ten'=>'required|min:1|max:255|unique:nhomtin,tennhomtin,'.$id_nhomtin.',id|regex:/[a-zA-Z]+/',
            ],
            [
                
                'ten.unique'=>'Đã tồn tại tên nhóm tin.',
                'ten.required'=>'Bạn chưa nhập tên nhóm tin.',
                'ten.min'=>'Tên nhóm tin phải có độ dài từ 1 - 255 ký tự.',
                'ten.max'=>'Tên nhóm tin phải có độ dài từ 1 - 255 ký tự.',
                'ten.regex'=>'Tên nhóm tin phải có chữ.',
                  
            ]

        );

       
        $nhomtin->tennhomtin=$request->ten;
        $nhomtin->nhomtinseo = str_slug($request->ten);
        $nhomtin->trangthai=$request->radios;
      
       $nhomtin->save();
         return redirect('admin/nhomtin/sua-'.$id_nhomtin.'.html')->with('thongbao','Sửa thành công.');

    }

     public function getxoa($id_nhomtin){
         $nhomtin=nhomtin::find($id_nhomtin);

         if(count($nhomtin->loaitin)==0)
           {
          
         $nhomtin->delete();
         return redirect('admin/nhomtin/danhsach.html')->with('thongbao','Xóa thành công.');
        }
         else
         {
             return redirect('admin/nhomtin/danhsach.html')->with('thongbao','Xóa không thành công.'); 
            // var_dump($nhomtin->loaitin);
         }
    }
}
