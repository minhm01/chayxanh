@extends('emp_layout')
@section('emp_content')
<?php    
    $dat = new DateTime(); 
    $date=($dat->format( 'N' )+1);
    $now=($dat->format('H:i'));    
    $msg=Session::get('message');
    if($msg)	{
        echo $msg;
        Session::put('message',null);
    }
    ?>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading" style="text-align: left">
      <p>Nhân viên: {{Session::get('employee')}}</p>
    </div>
    <div class="panel-heading" style="text-align: left">
      <p>Chi nhánh {{$branch->br_id}}: {{$branch->address}}</p>
    </div>      
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>                  
            <th>Ngày</th>                  
            @foreach($weekday as $wk)
            <th <?php if($wk->id==$date) echo 'class="btn-primary"'?>>{{$wk->day2}}</th>
            @endforeach
          </tr>                
        </thead>
        <tbody>                
          @foreach($shift as $sh)
          <tr>
            <td <?php if($sh->start<=$now&&$now<=$sh->end) echo 'class="btn-primary"'?>><h3>Ca {{$sh->shift_id}}</h2><br>{{substr($sh->start,0,5)}}-{{substr($sh->end,0,5)}}</td>
            @foreach($weekday as $wk)
            <td <?php if($sh->start<=$now&&$now<=$sh->end&&$wk->id==$date ) echo 'class="btn-primary"'; ?>>              
              @foreach($work as $wrk)  
              <?php 
               if($wrk->shift_id==$sh->shift_id&&$wrk->day==$wk->id) {                  
                switch($wrk->position) {
                  case 'manager': echo '<h3>Quản lý</h3>'; break;
                  case 'chef': echo '<h3>Bếp trưởng</h3>'; break;
                  case 'cook': echo '<h3>Bếp</h3>'; break;
                  case 'waiter': echo '<h3>Phục vụ</h3>';
                };              
              } ?>
              @endforeach              
            </td>
            @endforeach
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection