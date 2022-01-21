 @extends('admin.layout.index')
@section('content')  
         <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>sửa</small>
                        </h1>
                    </div>
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
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/user/sua/{{$user->id}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            
                            
                            <div class="form-group">
                                <label>Tên</label>
                                <input  class="form-control" name="name" value="{{$user->name}}" placeholder="nhập tên người dùng" />
                            </div>
                            <div class="form-group">
                                <label>email</label>
                                <input type="email" class="form-control" name="email" placeholder="nhập email người dùng" value="{{$user->email}}" readonly="" />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="changePassword" id="changePassword">
                                <label>đổi mật khẩu</label>
                                <input type="password" class="form-control password" name="password" placeholder="nhập mật khẩu" disabled="" />
                            </div>
                              <div class="form-group">
                                <label>xác nhận mật khẩu</label>
                                <input type="password" class="form-control password" name="passwordAgain" placeholder="nhập lại mật khẩu" disabled="" />
                            </div>
                            
                            <div class="form-group">
                                <label>Quyền</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1" checked="" type="radio">Admin
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0" type="radio">Thường
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">sửa</button>
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
 @section('script')
 <script >
     $(document).ready(function(){
        $("#changePassword").change(function(){
            if($(this).is(":checked")){
                $(".password").removeAttr('disabled');

            }
            else{
                $(".password").attr('disabled','');
            }
        });
     });
 </script>
 @endsection