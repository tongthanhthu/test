 @extends('admin.layout.index')
@section('content')  
         <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">slide
                            <small>sua</small>
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
                        <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                           
                            <div class="form-group">
                                
                            </div>
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="Ten" placeholder="Nhập Tên" value="{{$slide->Ten}}" />
                            </div>
                            
                             <div class="form-group">
                                <label>Nội Dung</label>
                                <textarea name="NoiDung" id="demo" class="form-control ckeditor" rows="6" >{{$slide->NoiDung}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>link</label>
                                <input class="form-control" name="Link" placeholder="Nhập link" value="{{$slide->link}}" />
                            </div>
                            <div class="form-group">
                                <label>Hình Ảnh</label>
                                <p><img width="400px" src="upload/slide/{{$slide->Hinh}}"></p>
                                <input type="file" name="Hinh" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-default">sua</button>
                            <button type="reset" class="btn btn-default">Làm Mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
 @endsection