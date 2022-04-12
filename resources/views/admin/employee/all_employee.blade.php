@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách nhân viên
    </div>
    <?php
    $msg=Session::get('message');
    if($msg)	{
        echo $msg;
        Session::put('message',null);
    }
    ?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th style="width:30px;"></th>
            <th>Tên</th>
            <th>Giới tính</th>
            <th>Chi nhánh</th>
            <th>Ngày vào làm</th>
            <th>SĐT</th>
            <th>Số CCCD</th>
            <th style="width:60px;">Chức vụ</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_employee as $key => $emp)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$emp->emp_id}}</td>
            <td>{{$emp->emp_name}}</td>
            <td>{{$emp->gender}}</td>
            <td><div title="{{$emp->address}}">{{$emp->br_id}}</div></td>
            <td>{{$emp->emp_dob}}</td>
            <td>{{$emp->emp_phone}}</td>
            <td>{{$emp->emp_pid}}</td>
            <td><div class="btn btn-light">
            <?php
            if($emp->role=="employee")
            {
              echo 'Nhân viên';
            }
            else {
              echo 'Quản lý';
            }
            ?>
            </div><a href="{{URL::to('/edit-work/'.$emp->emp_id)}}" class="btn btn-success">Xếp lịch</a></td>

            <td>
                <a href="{{URL::to('/edit-employee/'.$emp->emp_id)}}" class="btn btn-info">Sửa</a>
                <a onclick="return confirm('Xác nhận xóa nhân viên?')" href="{{URL::to('/del-employee/'.$emp->emp_id)}}" class="btn btn-danger">Xóa</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection