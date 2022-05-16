@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách chấm công
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
            <th>Mã nhân viên</th>
            <th>Chi nhánh</th>
            <th>Ngày</th>
            <th>Ca</th>
            <th>Giờ vào</th>
            <th>Giờ ra</th>
            <th>Thời gian</th>
            <th>Kết quả</th>            
          </tr>
        </thead>
        <tbody>
        @foreach($attend as $att)
        <?php if($admin||$att->br_id==$manager) { ?>
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <th>{{$att->emp_id}}</th>
            <th>{{$att->br_id}}</th>
            <th>{{$att->date}}</th>
            <th>{{$att->shift_id}}</th>
            <th>{{$att->checkin}}</th>
            <th>{{$att->checkout}}</th>
            <th>{{$att->duration}}</th>
            <th><div class="dropdown">
              <button class="btn btn-{{$att->button}} dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{$att->vie}}
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach($result as $res)
                <?php if($res->eng!=$att->result) { ?><a class="dropdown-item btn btn-{{$res->button}}" href="#">{{$res->vie}}</a><?php } ?>
                @endforeach
              </div>
            </div>
            </th>
          </tr>
        <?php } ?>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection