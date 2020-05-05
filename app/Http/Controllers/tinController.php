<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tin;
use App\nhomtin;
use App\loaitin;
use Illuminate\Support\Str;
class tinController extends Controller
{
    public function getdanhsach(){
    		$tin=tin::all();
    	return view('admin.tin.danhsach',['tin'=>$tin]);
    }
     public function getthem(){
	
     	$nhomtin=nhomtin::all();  $loaitin=loaitin::where('id_nhomtin',$nhomtin[0]->id)->get();
    	return view('admin.tin.them',['loaitin'=>$loaitin,'nhomtin'=>$nhomtin]);
    }

    public function postThem(Request $request)
    {
    	
    	$this->validate($request,[
    		'tieude'=>'required|min:1|max:255|unique:tin,tieude|regex:/[a-zA-Z]+/',
    		'loaitin'=>'required',
    		'tacgia'=>'required|min:1|max:255|regex:/[a-zA-Z]+/',
    		'mota'=>'required|regex:/[a-zA-Z]+/',
    		'tinhot'=>'required',
    		'noidung'=>'required|regex:/[a-zA-Z0-9]+/',
            'file'=>'required',
    	],[
    		'tieude.min'=>'Tiêu đề có độ dài từ 1 - 255 ký tự.',
            'tieude.max'=>'Tiêu đề có độ dài từ 1 - 255 ký tự.',
    		'tieude.required'=>'Tiêu đề chưa nhập.',
    		'tieude.unique'=>'Đã tồn tại.',
            'tieude.regex'=>'Phải có ký tự a-zA-Z.',

    		'loaitin.required'=>'Chưa chọn loại tin.',

    		'tacgia.min'=>'Tên tác có độ dài từ 1 - 255 ký tự.',
            'tacgia.max'=>'Tên tác có độ dài từ 1 - 255 ký tự.',
            'tacgia.regex'=>'Phải có ký tự a-zA-Z.',
            'tacgia.required'=>'Tên tác có độ dài từ 1 - 255 ký tự.',
    	    'mota.required'=>'Mô tả không được để trống.',
        	'noidung.required'=>'Nội dung không được để trống.',
            'noidung.regex'=>'Phải có ký tự a-zA-Z0-9.',


    	]);

    	$tin=new tin;
    	$tin->tieude=$request->tieude;
        $tin->tieudeseo=str_slug($request->tieude);
    	$tin->id_loaitin=$request->loaitin;
    	$tin->tacgia=$request->tacgia;
    	$tin->mota=$request->mota;
    	$tin->tinhot=$request->tinhot;
    	$tin->noidung=$request->noidung;
    	if($request->hasFile('file'))
    	{
    			$file=$request->file('file');
    			$name=$file->getClientOriginalName();
    			$hinh=str::random(4)."_".$name;
    			while ( file_exists("upload/tintuc/".$hinh)) {
    				$hinh=str_random(4)."_".$name;
    			}
    			$file->move("upload/tintuc/",$hinh);
    			$tin->hinhdaidien=$hinh;    			
    	}
    	else
    	{
    		$tin->hinhdaidien="";
    	}
    	$tin->save();
    	return redirect("admin/tin/them.html")->with('thongbao','Thêm thành công.');

    }

    public function getxoa($id_tin){
         $tin=tin::find($id_tin);
         if($tin==null)
          return redirect('admin/tin/danhsach.html')->with('thongbao','Không tồn tại tin.');
        // echo $tin->binhluan;
        if(count($tin->binhluan)==0)
        {
         $tin->delete();

             if (file_exists('upload/tintuc/'. $tin->hinhdaidien))
              {
                  unlink("upload/tintuc/".$tin->hinhdaidien);
              }

          return redirect('admin/tin/danhsach.html')->with('thongbao','Xóa thành công.');
      }
         else
         {
             return redirect('admin/tin/danhsach.html')->with('thongbao','Xóa thất bại tồn tại bình luận.');
         }
    }

    public function getsua($id_tin){

  	   $tin=tin::find($id_tin);

        if($tin==null)
          return redirect('admin/tin/danhsach.html')->with('thongbao','Không tồn tại tin.');
	   $loaitin=loaitin::find($tin->id_loaitin);

	   $idloaitin=$loaitin->id_loaitin;
       $nhomtin=nhomtin::find($loaitin->id_nhomtin);
       $idnhomtin=$nhomtin->id_nhomtin;
 	   $dsloaitin=$nhomtin->loaitin;
       $dsnhomtin=$nhomtin::all();

  return view('admin.tin.sua',['tin'=>$tin,'idloaitin'=>$idloaitin,'idnhomtin'=>$idnhomtin,'dsloaitin'=>$dsloaitin,'dsnhomtin'=>$dsnhomtin]);
        
    }

public function postsua(Request $request,$id_tin){

            $tin=tin::find($id_tin);
        
        $this->validate($request,[
            'tieude'=>'required|min:1|max:255|unique:tin,tieude,'.$id_tin.',id|regex:/[a-zA-Z]+/',
            'loaitin'=>'required',
            'tacgia'=>'required|min:1|max:255|regex:/[a-zA-Z]+/',
            'mota'=>'required|regex:/[a-zA-Z]+/|min:1|max:255|',
            'tinhot'=>'required',
            'noidung'=>'required|regex:/[a-zA-Z0-9]+/'
        ],[
            'tieude.min'=>'Tiêu đề phải có độ dài từ 1 - 255 ký tự.',
            'tieude.max'=>'Tiêu đề phải có độ dài từ 1 - 255 ký tự.',
            'tieude.required'=>'Tiêu đề chưa nhập.',
            'tieude.unique'=>'Tiêu đề đã tồn tại.',
             'tieude.regex'=>'Tên tác giả tối phải có a-zA-Z',

            'loaitin.required'=>'Chưa chọn loại tin.',

       


        'tacgia.required'=>'Tên tác giả phải có độ dài từ 1 - 255 ký tự.',
        'tacgia.min'=>'Tên tác giả phải có độ dài từ 1 - 255 ký tự.',
        'tacgia.max'=>'Tên tác giả phải có độ dài từ 1 - 255 ký tự.',
        'tacgia.regex'=>'Tên tác giả tối phải có a-zA-Z',


        'mota.required'=>'Mô tả không được để trống.',
        'mota.min'=>'Mô tả có độ dài từ 1 - 255 ký tự.',
        'mota.max'=>'Mô tả có độ dài từ 1 - 255 ký tự.',
        'mota.required'=>'Mô tả không được để trống.',


        'noidung.required'=>'Nội dung không được để trống.',
         'noidung.regex'=>'Nội dung a-zA-Z0-9.',



        ]);

        $tin->tieude=$request->tieude;
        $tin->tieudeseo=str_slug($request->tieude);
        $tin->id_loaitin=$request->loaitin;
        $tin->tacgia=$request->tacgia;
        $tin->mota=$request->mota;
        $tin->tinhot=$request->tinhot;
        $tin->noidung=$request->noidung;
        if($request->hasFile('file'))
        {
                $file=$request->file('file');
                $name=$file->getClientOriginalName();
                $hinh=str::random(4)."_".$name;
                while ( file_exists("upload/tintuc/".$hinh)) {
                    $hinh=str_random(4)."_".$name;
        }

        $file->move("upload/tintuc/",$hinh);
            if (file_exists('upload/tintuc/'. $tin->hinhdaidien))
            {
                 unlink("upload/tintuc/".$tin->hinhdaidien);
            }
                $tin->hinhdaidien=$hinh;
                
        }
       
        $tin->save();
        return redirect('admin/tin/sua-'.$id_tin.'.html')->with('thongbao','Sửa thành công.');
    }

}
