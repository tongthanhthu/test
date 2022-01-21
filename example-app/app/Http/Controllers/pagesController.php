<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;
use App\Models\Slide;
use App\Models\LoaiTin;
use App\Models\TinTuc;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class pagesController extends Controller
{
    public function __construct()
    {
        $slide = Slide::all();
        view()->share('slide',$slide); 
        $theloai =TheLoai::all();
        view()->share('theloai',$theloai);

    }
   public function trangchu(){
        $theloai = TheLoai::all();
        return view('pages.trangchu');
    }
    public function lienhe(){
        
        return view('pages.lienhe');
    }
    public function loaitin($id){
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
        return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }
    public function tintuc($id){
        $tintuc = TinTuc::find($id);
        $tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan =TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }
    public function getdangnhap(){
        return view('pages.dangnhap');
    }
    public function postdangnhap(Request $request){
       $this->validate($request,[
        'email'=>'required',
        'password'=>'required|min:3|max:20'
    ],[
        'email.required'=>' bạn chưa nhập email',
        'password.required'=>'bạn chưa nhập password',
        'password.min'=>'mật khẩu quá ngắn ',
        'password.max'=>'mật khẩu quá dài'
    ]);
     if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
        return redirect('trangchu');
     }
     else{
        return redirect('dangnhap')->with('thongbao','đăng nhập thất bại');
     }

    }
    public function dangxuat()
    {
        Auth::logout();
     return redirect('dangnhap');
    } 
    public function getnguoidung()
    {
        return view('pages.nguoidung');
    }
    public function postnguoidung(Request $request)
    {
    $this->validate($request,['name'=>'required|min:3'
        ],[
            'name.required'=>'bạn chưa nhập tên người dùng',
            'name.min'=>'bạn cần ít nhất 3 ký tự',

        ]);
        $user = Auth::user();
        $user->name = $request->name;
       
        if($request->checkpassword == "on"){
             $this->validate($request,[
            'password'=>'required|min:3|max:20',
            'passwordAgain'=>'required|same:password'
        ],[
            'password.required'=>'bạn chưa nhập email ',
            'password.min'=>' cần ít nhất 3 ký tự ',
            'password.max'=>'tối đa 32 ký tự',
            'passwordAgain.required'=>'bạn chưa nhập lại mật khẩu',
            'passwordAgain.same'=>'mật khẩu không khớp'

        ]);

        $user->password = bcrypt($request->password);
    }
        $user->save();
        return redirect('trangchu')->with('thongbao','sửa thành công');
    }
    public function getdangky(){
        return view('pages.dangky');
    }
    public function postdangky(Request $request)
    {
         $this->validate($request,['name'=>'required|min:3',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:3|max:20',
            'passwordAgain'=>'required|same:password'
        ],[
            'name.required'=>'bạn chưa nhập tên người dùng',
            'name.min'=>'bạn cần ít nhất 3 ký tự',
            'email.required'=>'bạn chưa nhập email',
            'email.email'=>'bạn chưa nhập đúng định danh email',
            'email.unique'=>'email đã tồn tại',
            'password.required'=>'bạn chưa nhập email ',
            'password.min'=>' cần ít nhất 3 ký tự ',
            'password.max'=>'tối đa 32 ký tự',
            'passwordAgain.required'=>'bạn chưa nhập lại mật khẩu',
            'passwordAgain.same'=>'mật khẩu không khớp'

        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->quyen = 0;
        $user->save();
        return redirect('dangky')->with('thongbao','thêm thành công');

    }
    public function timkiem(Request $request){
         $tukhoa = $request->tukhoa;
         $tintuc = TinTuc::where('TieuDe','like',"%$tukhoa%")->orwhere('TomTat','like',"%$tukhoa%")->orwhere('NoiDung','like',"%$tukhoa%")->take(30)->paginate(5);
         return view('pages.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
    }
    
}
