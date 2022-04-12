@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Phân công công việc
            </header>
            <div class="panel-body">
                <?php
                $brch=Session::get('br');
                $msg=Session::get('message');
                if($msg)	{
                    echo $msg;
                    Session::put('message',null);
                }
                ?>
                @foreach($employee as $key => $emp)
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-work/'.$emp->emp_id)}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">Tên nhân viên </label>
                            <input type="text" class="form-control" value="{{$emp->emp_name}}" name="name" placeholder="" disabled>
                        </div>
                        <div class="form-group">
                            <label for="name">Chi nhánh </label>
                            <input type="text" class="form-control" value="{{$emp->br_id}}.{{$emp->address}}" name="name" placeholder="" disabled>
                        </div>
                        <label for="gender">Ca làm </label>
                        <select class="form-control input-lg m-bot15" name="shift" required>                            
                            @foreach($shift as $key => $s)
                            <option value={{$s->shift_id}}>Ca {{$s->shift_id}}. Từ {{substr($s->start,0,5)}} giờ đến {{substr($s->end,0,5)}} giờ</option>
                            @endforeach
                        </select>
                        <div class="checkbox" name="day[]">
                            @foreach($weekday as $key => $day)
                            <label>
                                <input type="checkbox" value={{$day->id}}>{{$day->day2}}
                            </label>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="pid">Số CCCD </label>
                            <input type="text" class="form-control" value="{{$emp->emp_pid}}" name="pid" placeholder="" required>
                        </div>                               
                    <button type="submit" name="add_branch" class="btn btn-info">Sửa</button>
                    <?php
                    $admin=Session::get('ad_user');
                    if($admin){
                        if($emp->role=="employee"){ ?>
                        <a href="{{URL::to('/promote/'.$emp->emp_id)}}"class="btn btn-success">Thăng chức</a>
                    <?php }
                    else{ ?>
                        <a href="{{URL::to('/demote/'.$emp->emp_id)}}" class="btn btn-danger">Cách chức</a>'
                    <?php }} ?>
                </form>
                </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
