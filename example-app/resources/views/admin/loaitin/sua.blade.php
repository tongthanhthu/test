@extends('admin.layout.index')
@section('content')   
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">loại Tin
                            <small>{{$loaitin->Ten}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                     @if(count($errors) > 0)
                         <div class="alert alert-danger">
                             @foreach($errors->all() as $err)
                             {{$err}}<br>
                             @endforeach
                         </div>
                         @endif
                         @if(session('thongbao'))
                         <div class="alert alert-danger">
                             {{session('thongbao')}}
                         </div>
                         @endif
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/loaitin/sua/{{$loaitin->id}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Thể Loại</label>
                                <select class="form-control" name="TheLoai">
                                   @foreach($theloai as $tl)

                                    <option 
                                     @if($loaitin->idTheLoai == $tl->id)
                                    {{"selected"}}
                                    @endif
                                     value="{{$tl->id}}">{{$tl->Ten}} </option>
                                     @endforeach
                                </select>
                               
                            </div>
                            <div  class="form-group">
                                <label>Tên Loại Tin</label>
                                <input class="form-control" name="Ten" placeholder="Nhập Tên Loại Tin" />
                            </div>
                           
                            <button type="submit" class="btn btn-default">sửa </button>
                            <button type="reset" class="btn btn-default">làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection