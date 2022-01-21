 @extends('admin.layout.index')
@section('content')  
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">user
                            <small>danh sách</small>
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
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>quyen</th>
                                <th>email</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $u)
                            <tr class="odd gradeX" align="center">
                                <td>{{$u->id}}</td>
                                <td>{{$u->name}}</td>
                                <td>{{$u->email}}</td>
                                <td>
                                    @if($u->quyen == 1)
                                    {{"admin"}}
                                    @else
                                    {{"thường"}}
                                    @endif
                                </td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/user/xoa/{{$u->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/user/sua/{{$u->id}}">Edit</a></td>
                            </tr>
                            @endforeach
                            
                            
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
 @endsection