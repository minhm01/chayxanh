@extends('admin_layout')
@section('admin_content')
<?php
    
    $dat = new DateTime(); $date=($dat->format( 'N' )+1);
    $msg=Session::get('message');
    if($msg)	{
        echo $msg;
        Session::put('message',null);
    }
    $admin=Session::get('ad_id');
    $manager=Session::get('br');
    $head=1;
    ?>
@foreach($branch as $branch)
<?php if($admin||$branch->br_id==$manager) { ?>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading" style="text-align: left">
      Chi nhánh {{$branch->br_id}}. {{$branch->address}}
    </div>    

      <ul class="nav nav-pills nav-justified">
        @foreach($week as $wk)
        <li <?php if($wk->id==$date) echo 'class="active"'; ?>><a data-toggle="pill" href="#day{{$wk->id}}br{{$branch->br_id}}">{{$wk->day2}}</a></li>      
        @endforeach
      </ul>

    <div class="tab-content">
      @foreach($week as $wk)
      <div id="day{{$wk->id}}br{{$branch->br_id}}" class="tab-pane fade <?php if($wk->id==$date) { ?> in active <?php } ?> ">
        <ul class="nav nav-pills nav-stacked">
          <div class="table-responsive">
            <table class="table table-striped b-t b-light">
              <thead>
                <tr>
                  <th style="width:25%;">Ca</th>
                  <th>Vị trí</th>
                  <th>Nhân viên</th>
                </tr>
              </thead>
              <tbody>
                @foreach($shift as $sh)
                @foreach($position as $pos)
                <tr>
                  <?php if($head==1) { $head=0; ?>
                  <td rowspan="4" style="font-size: 40px">{{$sh->shift_id}}</br>{{substr($sh->start,0,5)}}-{{substr($sh->end,0,5)}}
                  </td> <?php } ?>
                  <td><span class="text-ellipsis">{{$pos->vie}}</span></td>
                  <td><span class="text-ellipsis">
                    @foreach($work as $wrk)  
                    <?php if($wrk->br_id==$branch->br_id&&$wrk->shift_id==$sh->shift_id&&$wrk->day==$wk->id&&$wrk->position==$pos->eng) { ?>
                    <div>{{$wrk->emp_name}}</div>
                    <?php }?>
                    @endforeach  
                  </span></td>
                </tr>
                @endforeach
                <?php $head=1; ?>
                @endforeach
              </tbody>
            </table>
          </div>          
        </ul>
      </div>      
      @endforeach
    </div>
  </div>
</div>
<?php } ?>
@endforeach
@endsection