@extends('admin_layout')
@section('admin_content')
<?php 
$dat = new DateTime(); $date=$dat->format( 'Y-m-d' );?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Yêu cầu bổ sung nhân viên
            </header>
            <div class="panel-body">
                <?php
                $msg=Session::get('message');
                if($msg)	{
                    echo $msg;
                    Session::put('message',null);
                }
                ?>
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-dispatch')}}" method="post">
                        {{csrf_field()}}
                    <div class="form-group">
                        <label for="address">Chi nhánh</label>
                        <input type="text" class="form-control" name="address" value="{{$br->br_id}}. {{$br->address}}" readonly>
                    </div>
                    <input type="hidden" name="br" value={{$br->br_id}}>
                    <div class="form-group">
                        <label for="address">Ngày</label>
                        <input type="date" class="form-control" name="date" min="{{$date}}">
                    </div>
                    <label for="position">Vị trí</label>
                    <div class="form-group checkbox">
                        <div class="col-sm-4"><label><input type="checkbox" name="pos[]" value="chef">Bếp trưởng</label></div>
                        <div class="col-sm-4"><label><input type="checkbox" name="pos[]" value="cook">Bếp</label></div>
                        <div class="col-sm-4"><label><input type="checkbox" name="pos[]" value="waiter">Phục vụ</label></div>
                    </div>
                    <label for="position">Ca</label>
                    <div class="form-group checkbox">
                        @foreach($shift as $sh)
                        <label><input type="checkbox" name="shift[]" value={{$sh->shift_id}}>Ca {{$sh->shift_id}}</label>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="address">Ghi chú</label>
                        <textarea class="form-control" name="note"></textarea>
                    </div>
                    <button type="submit" name="add_dispatch" class="btn btn-info">Gửi</button>
                </form>
                </div>
            </div>
        </section>
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
