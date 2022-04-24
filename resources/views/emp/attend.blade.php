@extends('emp_layout')
@section('emp_content')
@inject('attendance', 'App\Http\Controllers\Attendance')
<?php    
    $dat = new DateTime(); 
    $date=($dat->format( 'N' )+1);
    $now=($dat->format('H:i'));
    $msg=Session::get('message');
    if($msg)	{
        echo $msg;
        Session::put('message',null);
    }
    $shift_now=0;
?>
<div class="col-md-6">
  <div class="calendar-widget">
    <div class="panel-heading ui-sortable-handle">
      <span class="panel-icon">
        <i class="fa fa-calendar-o"></i>
      </span>
      <span class="panel-title"> chấm công</span>
    </div>
    <h1 style="font-size:8vw;"><div id="clock"></div></h1>
    <div class="col-md-6">
      <form action="{{URL::to('/checkin')}}" method="post">
        {{csrf_field() }}        
        <input type="hidden" name="checkin" value={{$now}}>
        <input type="submit" value="Giờ vào" class="btn btn-success btn-lg btn-block">			
      </form>
      
    </div>
    <div class="col-md-6"><a class="btn btn-info btn-lg btn-block" href="{{URL::to('/checkout')}}">Giờ ra</a></div>
  </div>
  <div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">ca trong ngày</div>
      <div>
        <table class="table">
          <thead>
            <tr>
              <th>Ca</th>
              <th>Chi nhánh</th>
              <th>Vị trí</th>
              <th>Giờ vào</th>
              <th>Giờ ra</th>
              <th>Trạng thái</th>
            </tr>
          </thead>
          <tbody>
            @foreach($shift as $sh)
            <tr>
              <td>{{$sh->shift_id}}</td>
              @foreach($work as $wrk)              
              <?php if($wrk->shift_id==$sh->shift_id) {?>
              <td title="{{$wrk->address}}">{{$wrk->br_id}}</td>
              <td>{{$wrk->vie}}</td>
              <td><?php if(1) echo 1; ?></td>
              <td><?php if(1) echo 1; ?></td>
              <td><?php if(1) echo 1; ?></td>
              <?php }else{ ?>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>              
              <?php } ?>
              @endforeach
            </tr>            
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>  
</div>
<div class="col-md-6 agile-calendar">
  <div class="calendar-widget">
    <div class="panel-heading ui-sortable-handle">
      <span class="panel-icon">
        <i class="fa fa-calendar-o"></i>
      </span>
      <span class="panel-title"> ngày làm việc</span>
    </div>
    <div class="agile-calendar-grid">
      <div class="page">
        <div class="w3l-calendar-left">
          <div class="calendar-heading">            
          </div>
          <div class="monthly" id="mycalendar"></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection