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
    $admin=Session::get('ad_id');
    $manager=Session::get('br');
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
            <th>Chức vụ</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_employee as $key => $emp)
        <?php if($admin||$emp->br_id==$manager) { ?>
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
              <?php if($emp->role=="employee")
            {
              ?>Nhân viên</div><?php
            }
            else {
              ?>Quản lý</div><?php
            }
            ?><div><a href="{{URL::to('/add-work/'.$emp->emp_id)}}" class="btn btn-success">Xếp lịch</a></div>
            </td>

            <td>
                <a href="{{URL::to('/edit-employee/'.$emp->emp_id)}}" class="btn btn-info">Sửa</a>
                <a onclick="return confirm('Xác nhận xóa nhân viên?')" href="{{URL::to('/del-employee/'.$emp->emp_id)}}" class="btn btn-danger">Xóa</a>
            </td>
          </tr>
          <?php } ?>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection