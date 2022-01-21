<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiTin;
use App\Models\TheLoai;
use App\Models\TinTuc;
use Illuminate\Support\Str;

class TinTucController extends Controller
{
    //
    public function getDanhSach(){
        $tintuc = TinTuc::orderBy('id','DESC')->get();
        return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
     
    }
    public function getThem(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
     
    }

    public function postThem(Request $request)
    {
         $this->validate($request,[
            'LoaiTin'=>'required',
            'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
            'TomTat'=>'required',
            'NoiDung'=>'required'
         ],[
            'LoaiTin.required'=>'bạn chưa chọn loại tin',
            'TieuDe.required'=>'bạn chưa nhập tiêu đề',
            'TieuDe.min'=>'bạn cần nhập ít nhất 3 ký tự',
            'TieuDe.unique'=>'tiêu đề đã tồn tại',
            'TomTat.required'=>'bạn chưa nhập tóm tắt',
            'NoiDung.required'=>'bạn chưa nhập nội dung'


         ]);
         $tintuc = new TinTuc;
         $tintuc->TieuDe =$request->TieuDe;
         $tintuc->TieuDeKhongDau =changeTitle($request->TieuDe);
         $tintuc->idLoaiTin = $request->LoaiTin;
         $tintuc->TomTat =$request->TomTat;
         $tintuc->NoiDung = $request->NoiDung;
         $tintuc->SoLuotXem =0;
         if($request->hasFile('Hinh'))
         {
            $file =$request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi !='jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                 return redirect('admin/tintuc/them')->with('thongbao','chỉ chọn được file ảnh');

            }
            $name = $file->getClientOriginalName();
            $Hinh =str::random(4)."_".$name;
            while(file_exists("upload/tintuc/".$Hinh))
            {
                 $Hinh =str::random(4)."_".$name;

            }
            $file->move("upload/tintuc/",$Hinh);
            $tintuc->Hinh =$Hinh;
         }
         else{
            $tintuc->Hinh = "";

         }
         $tintuc->save();
         return redirect('admin/tintuc/them')->with('thongbao','thêm thành công');


    }
    public function getSua($id){
        $theloai =TheLoai::all();
        $loaitin = LoaiTin::all();
        $tintuc = TinTuc::find($id);
        return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
       

    }
    public function postsua(Request $request,$id ){
       $tintuc =TinTuc::find($id);
         $this->validate($request,[
            'LoaiTin'=>'required',
            'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
            'TomTat'=>'required',
            'NoiDung'=>'required'
         ],[
            'LoaiTin.required'=>'bạn chưa chọn loại tin',
            'TieuDe.required'=>'bạn chưa nhập tiêu đề',
            'TieuDe.min'=>'bạn cần nhập ít nhất 3 ký tự',
            'TieuDe.unique'=>'tiêu đề đã tồn tại',
            'TomTat.required'=>'bạn chưa nhập tóm tắt',
            'NoiDung.required'=>'bạn chưa nhập nội dung'


         ]);

          $tintuc->TieuDe =$request->TieuDe;
         $tintuc->TieuDeKhongDau =changeTitle($request->TieuDe);
         $tintuc->idLoaiTin = $request->LoaiTin;
         $tintuc->TomTat =$request->TomTat;
         $tintuc->NoiDung = $request->NoiDung;
         
         if($request->hasFile('Hinh'))
         {
            $file =$request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi !='jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                 return redirect('admin/tintuc/them')->with('thongbao','chỉ chọn được file ảnh');

            }
            $name = $file->getClientOriginalName();
            $Hinh =str::random(4)."_".$name;
            while(file_exists("upload/tintuc/".$Hinh))
            {
                 $Hinh =str::random(4)."_".$name;

            }
            $file->move("upload/tintuc/",$Hinh);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh =$Hinh;
         }
         
         $tintuc->save();
         return redirect('admin/tintuc/sua/'.$id)->with('thongbao','sửa thành công');
    }
    public function getxoa($id){
        $tintuc = TinTuc::find($id);
        $tintuc ->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao','bạn đã xóa thành công');
        
  }
    

}
