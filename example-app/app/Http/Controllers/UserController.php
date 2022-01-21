<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiTin;
use App\Models\TheLoai;
use App\Models\TinTuc;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    
    
    public function getDanhSach()
    {
        $user = User::all();
        return view('admin.user.danhsach',['user'=>$user]);
    }
    public function getThem(){
        return view('admin.user.them');
       
     
    }

    public function postThem(Request $request)
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
        $user->quyen = $request->quyen;
        $user->save();
        return redirect('admin/user/them')->with('thongbao','thêm thành công');



    }
    public function getSua($id){
        $user = User::find($id);
         return view('admin.user.sua',['user'=>$user]);
       
       

    }
    public function postsua(Request $request,$id ){
        $this->validate($request,['name'=>'required|min:3'
        ],[
            'name.required'=>'bạn chưa nhập tên người dùng',
            'name.min'=>'bạn cần ít nhất 3 ký tự',

        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->quyen = $request->quyen;
        if($request->changePassword == "on"){
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
        return redirect('admin/user/sua/'.$id)->with('thongbao','sửa thành công');
    }
      
  

            
    public function getxoa($id){
        $user = User::find($id);
        $comment = Comment::where('idUser',$id);
        $comment->delete();
        $user->delete();
        return redirect('admin/user/danhsach')->with('thongbao','Xóa tài khoản thành công');
       
        
  }
  public function getdangnhap()
  {
      return view('admin.login');
  }
   public function postdangnhap(Request $request)
   {
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
        return redirect('admin/theloai/danhsach');
     }
     else{
        return redirect('admin/dangnhap')->with('thongbao','đăng nhập thất bại');
     }

   }
   public function getdangxuat()
   {
    Auth::logout();
    return redirect('admin/dangnhap');
   }
    

}
