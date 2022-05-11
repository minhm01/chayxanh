@extends('admin_layout')
@section('admin_content')
<?php
$msg=Session::get('message');
if($msg)	{
    echo $msg;
    Session::put('message',null);
}
?>
<div class="table-agile-info">
  <div class="panel panel-danger">
    <div class="panel-heading">
      yêu cầu chưa xử lý
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Chi nhánh</th>
            <th>Ngày</th>
            <th>Ca</th>
            <th>Vị trí</th>
            <th>Ghi chú</th>
            <th>Ngày gửi</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($dispatch as $dp)
          <?php if(!($dp->result)) {?>
          <tr>
            <td>
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </td>
            <td title="{{$dp->address}}">{{$dp->br_id}}</td>
            <td>{{$dp->date}}</td>
            <td>{{$dp->shift_id}}</td>
            <td>@foreach($pos as $ps)
              <?php if(str_contains($dp->position,$ps->eng)) echo $ps->vie.'<br>' ?>
            @endforeach</td>
            <td>{{$dp->note}}</td>
            <td>{{date_format(new Datetime($dp->created_at),'Y-m-d')}}</td>
            <td>
              <a class="btn btn-success" href="{{URL::to('/send-dispatch/'.$dp->dp_id)}}">Điều phối</a>
            </td>
          </tr>
          <?php } ?>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      yêu cầu đã xử lý
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Chi nhánh</th>
            <th>Ngày</th>
            <th>Ca</th>
            <th>Số nhân viên</th>
            <th>Ghi chú</th>
            <th>Ngày gửi</th>
            <th>Ngày xử lý</th>
          </tr>
        </thead>
        <tbody>
          @foreach($dispatch as $dp)
          <?php if($dp->result) {?>
          <tr>
            <td>
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </td>
            <td title="{{$dp->address}}">{{$dp->br_id}}</td>
            <td>{{$dp->date}}</td>
            <td>{{$dp->shift_id}}</td>
            <td>{{$dp->emp}}</td>
            <td>{{$dp->note}}</td>
            <td>{{date_format(new Datetime($dp->created_at),'Y-m-d')}}</td>
            <td>{{date_format(new Datetime($dp->updated_at),'Y-m-d')}}</td>
          </tr>
          <?php } ?>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection