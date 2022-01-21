<?php

use Illuminate\Support\Facades\Route;
use App\Models\TheLoai;
use App\Http\Controllers\TheLoaiContrller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
 route::get('admin/dangnhap','App\Http\Controllers\UserController@getdangnhap');
 route::post('admin/dangnhap','App\Http\Controllers\UserController@postdangnhap');
 route::get('admin/logout','App\Http\Controllers\UserController@getdangxuat');

route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
    route::group(['prefix'=>'theloai'],function(){

            route::get('danhsach','App\Http\Controllers\TheLoaiController@getDanhSach');
            route::get('sua/{id}','App\Http\Controllers\TheLoaiController@getSua');
            route::post('sua/{id}','App\Http\Controllers\TheLoaiController@postSua');
            route::get('them','App\Http\Controllers\TheLoaiController@getThem');
            route::post('them','App\Http\Controllers\TheLoaiController@postThem');
            route::get('xoa/{id}','App\Http\Controllers\TheLoaiController@getxoa');

    });
   route::group(['prefix'=>'loaitin'],function(){

       route::get('danhsach','App\Http\Controllers\LoaiTinController@getDanhSach');

            route::get('sua/{id}','App\Http\Controllers\LoaiTinController@getSua');
            route::post('sua/{id}','App\Http\Controllers\LoaiTinController@postSua');
            route::get('them','App\Http\Controllers\LoaiTinController@getThem');
            route::post('them','App\Http\Controllers\LoaiTinController@postThem');
            route::get('xoa/{id}','App\Http\Controllers\LoaiTinController@getxoa');

    });
   route::group(['prefix'=>'tintuc'],function(){

        route::get('danhsach','App\Http\Controllers\TinTucController@getDanhSach');
            route::get('sua/{id}','App\Http\Controllers\TinTucController@getSua');
            route::post('sua/{id}','App\Http\Controllers\TinTucController@postSua');
            route::get('them','App\Http\Controllers\TinTucController@getThem');
            route::post('them','App\http\Controllers\TinTucController@postThem');
            route::get('xoa/{id}','App\Http\Controllers\TinTucController@getXoa');

    });
   route::group(['prefix'=>'comment'],function(){
            route::get('xoa/{id}/{idTinTuc}','App\Http\Controllers\CommentController@getXoa');

    });
   route::group(['prefix'=>'slide'],function(){

            route::get('danhsach','App\Http\Controllers\SlideController@getDanhSach');
            route::get('xoa/{id}','App\Http\Controllers\SlideController@getxoa');
            route::get('them','App\http\Controllers\SlideController@getthem');
            route::post('them','App\http\Controllers\SlideController@postthem');
            route::get('sua/{id}','App\http\Controllers\SlideController@getsua');
    route::post('sua/{id}','App\http\Controllers\SlideController@postsua');


    });
   route::group(['prefix'=>'user'],function(){

            route::get('danhsach','App\Http\Controllers\UserController@getDanhSach');
            route::get('sua/{id}','App\Http\Controllers\UserController@getSua');
            route::post('sua/{id}','App\Http\Controllers\UserController@postSua');
            route::get('them','App\Http\Controllers\UserController@getThem');
            route::post('them','App\Http\Controllers\UserController@postThem');
            route::get('xoa/{id}','App\Http\Controllers\UserController@getxoa');
            

    });
   route::group(['prefix'=>'ajax'],function(){
       route::get('loaitin/{idTheLoai}','App\Http\Controllers\AjaxController@getLoaiTin');
   });

  
 
});
route::get('trangchu','App\Http\Controllers\pagesController@trangchu');
route::get('lienhe','App\Http\Controllers\pagesController@lienhe');
route::get('loaitin/{id}/{TenKhongDau}.html','App\Http\Controllers\pagesController@loaitin');
route::get('tintuc/{id}/{TieuDeKhongDau}.html','App\Http\Controllers\pagesController@tintuc');
route::get('dangnhap','App\Http\Controllers\pagesController@getdangnhap');
route::post('dangnhap','App\Http\Controllers\pagesController@postdangnhap');
route::get('dangxuat','App\Http\Controllers\pagesController@dangxuat');
route::post('comment/{id}','App\Http\Controllers\CommentController@binhluan');
route::get('nguoidung','App\Http\Controllers\pagesController@getnguoidung');
route::post('nguoidung','App\Http\Controllers\pagesController@postnguoidung');
route::get('dangky','App\Http\Controllers\pagesController@getdangky');
route::post('dangky','App\Http\Controllers\pagesController@postdangky');
route::post('timkiem','App\Http\Controllers\pagesController@timkiem');

