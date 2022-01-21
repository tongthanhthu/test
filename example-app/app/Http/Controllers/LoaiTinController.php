<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiTin;
use App\Models\TheLoai;

class LoaiTinController extends Controller
{
    //
    public function getDanhSach(){
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);

    }
    public function getThem(){
         $theloai =TheLoai::all();
        return view('admin.loaitin.them',['theloai'=>$theloai]);
    }


    public function postThem(Request $request)
    {
        $this->validate($request,[
            'Ten' =>'required|unique:LoaiTin,Ten|min:3|max:100',
            'TheLoai'=>'required'

        ],[
                 'Ten.required'=>'bạn chưa nhập tên',
                'Ten.unique'=>'ten đã tồn tại',
                'Ten.min'=>'ít nhất 3 ký tự',
                'Ten.max'=>'qua dai',
                'TheLoai.required'=>'bạn chưa chọn thể loại'
            ]);
        $loaitin = new LoaiTin;
        $loaitin->Ten =$request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao','thêm thành công');


        

    }
    public function getsua($id){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::find($id);
        return view ('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
       

    }
    public function postsua(Request $request,$id ){
        $this->validate($request,[
            'Ten' =>'required|unique:LoaiTin,Ten|min:3|max:100',
            'TheLoai'=>'required'

        ],[
                'Ten.required'=>'bạn chưa nhập tên',
                'Ten.unique'=>'ten đã tồn tại',
                'Ten.min'=>'ít nhất 3 ký tự',
                'Ten.max'=>'qua dai',
                'TheLoai.required'=>'bạn chưa chọn thể loại'
            ]);
        
        $loaitin = LoaiTin::find($id);
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai= $request->TheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','bạn đã sửa thành công');

    }
    public function getxoa($id){
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/danhsach')->with('thongbao','bạn đã xóa thành công');
        
  }
    

}
