<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;

class TheLoaiController extends Controller
{
    //
    public function getDanhSach(){
        $theloai = TheLoai::all();
        return view('admin.theloai.danhsach',['theloai'=>$theloai]);

    }
    public function getThem(){
        return view('admin.theloai.them');
    }
    public function postThem(Request $request)
    {
        $this->validate($request,['Ten' => 'required|min:3|max:100|unique:TheLoai,Ten'],
            [
                'Ten.required'=>'bạn chưa nhập tên thể loại',
                'Ten.min'=>'Tên thể loại phải có độ dài từ 3 đén 100 ký tự',
                'Ten.max'=>'Tên thể loại quá dài',
                'Ten.required'=>'bạn Chưa Nhập Tên Thể Loại'
            ]);
        $theloai = new TheLoai;
        $theloai->Ten =$request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao','Thêm Thành Công');

    }
    public function getsua($id){
        $theloai = TheLoai::find($id);
        return view('admin.theloai.sua',['theloai' =>$theloai]);

    }
    public function postsua(Request $request,$id ){
        $theloai = TheLoai::find($id);
        $this->validate($request,
            [
               'Ten' =>'required|unique:TheLoai,Ten|min:3|max:100'
           ]
            ,[
                'Ten.required'=>'bạn Chưa Nhập Tên Thể Loại',
                'Ten.unique' =>'Tên Thể Loại Đã Tồn Tại',
                'Ten.min'=>'tên Thể Loại Ít Nhất 3 Ký Tự',
                'Ten.max'=>'Tên Thể Loại dưới 100Ký Tự'

            ]);
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau =changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/sua/'.$id)->with('thongbao','Them Thanh cong');

    }
    public function getxoa($id){
        $theloai = TheLoai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao','bạn đã xóa thành công');
  }
    

}
