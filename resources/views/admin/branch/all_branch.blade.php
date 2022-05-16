@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách chi nhánh
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
            <th>Địa chỉ</th>
            <th></th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_branch as $key => $br)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$br->br_id}}</td>
            <td>{{$br->address}}</td>
            <td>Jul 22, 2013</td>
            <td>
                <a href="{{URL::to('/edit-branch/'.$br->br_id)}}" ui-toggle-class=""><i class="fa fa-pencil"></i>
                <a onclick="return confirm('Xác nhận xóa chi nhánh?')" href="{{URL::to('/del-branch/'.$br->br_id)}}" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection