<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiTin;
use App\Models\TheLoai;
use App\Models\TinTuc;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    
    public function getXoa($id,$idTinTuc){
        $comment = Comment::find($id);
        $comment->delete();
        return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thongbao','bạn đã xóa thành công');
        
  }
   public function binhluan(Request $request,$id){
    $idTinTuc = $id;
    $comment = new Comment;
    $tintuc = TinTuc::find($id);
    $comment->idTinTuc = $idTinTuc;
    $comment->idUser = Auth::user()->id;
    $comment->NoiDung = $request->NoiDung;
    $comment->save();
    return redirect("tintuc/$id/".$tintuc->TieuDeKhongDau.".html")->with('thongbao','viet binh luan thanh cong');
   } 

}
