<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiTin;
use App\Models\TheLoai;
use App\Models\Slide;
use Illuminate\Support\Str;
class SlideController extends Controller
{
    //
    public function getDanhSach(){
        $slide = Slide::all();
        return view('admin.slide.danhsach',['slide'=>$slide]);

    }
    public function getthem(){
        return view('admin.slide.them');
        
    }


    public function postthem(Request $request)
    {
       $this->validate($request,[
        'Ten'=>'required',
        'NoiDung'=>'required'
       ],[
        'Ten.required'=>'bạn chưa nhập tên',
        'NoiDung.required'=>'bạn chưa nhập nội dung'
       ]);

       $slide = new Slide;
       $slide->Ten = $request->Ten; 
       $slide->NoiDung =$request->NoiDung;
       if($request->has('Link'))
        $slide->Link=$request->Link;

        if($request->hasFile('Hinh'))
         {
            $file =$request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi !='jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                 return redirect('admin/slide/them')->with('thongbao','chỉ chọn được file ảnh');

            }
            $name = $file->getClientOriginalName();
            $Hinh = str::random(4)."_".$name;
            while(file_exists("upload/slide/".$Hinh))
            {
                 $Hinh = str::random(4)."_".$name;

            }
            $file->move("upload/slide/",$Hinh);
            $slide->Hinh =$Hinh;
         }
         else{
            $slide->Hinh = "";

         }
         $slide->save();
         return redirect('admin/slide/them')->with('thongbao','thêm thành công');

    }
    public function getsua($id){
        $slide = Slide::find($id);
        return view('admin.slide.sua',['slide'=>$slide]);
        
       

    }
    public function postsua(Request $request,$id ){
         $this->validate($request,[
        'Ten'=>'required',
        'NoiDung'=>'required'
       ],[
        'Ten.required'=>'bạn chưa nhập tên',
        'NoiDung.required'=>'bạn chưa nhập nội dung'
       ]);

       $slide =Slide::find($id);
       $slide->Ten = $request->Ten; 
       $slide->NoiDung =$request->NoiDung;
       if($request->has('Link'))
        $slide->Link=$request->Link;

        if($request->hasFile('Hinh'))
         {
            $file =$request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi !='jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                 return redirect('admin/slide/them')->with('thongbao','chỉ chọn được file ảnh');

            }
            $name = $file->getClientOriginalName();
            $Hinh = str::random(4)."_".$name;
            while(file_exists("upload/slide/".$Hinh))
            {
                 $Hinh = str::random(4)."_".$name;

            }
            unlink("upload/slide/".$slide->Hinh);
            $file->move("upload/slide/",$Hinh);
            $slide->Hinh =$Hinh;
         }
         $slide->save();
         return redirect('admin/slide/sua/'.$id)->with('thongbao','sửa thành công');
       

    }
    public function getxoa($id){
        $slide = Slide::find($id);
        $slide ->delete();
        return redirect('admin/slide/danhsach')->with('thongbao','xóa thành công');
       
        
  }
    

}
