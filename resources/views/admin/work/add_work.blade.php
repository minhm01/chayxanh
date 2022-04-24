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
                    <form role="form" action="{{URL::to('/save-work')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" value={{$emp->emp_id}} name="id">
                        <input type="hidden" value={{$emp->br_id}} name="branch">
                        <div class="form-group">
                            <label for="name">Tên nhân viên </label>
                            <input type="text" class="form-control" value="{{$emp->emp_name}}" name="name" placeholder="" disabled>                            
                        </div>
                        <div class="form-group">
                            <label for="name">Chi nhánh </label>
                            <input type="text" class="form-control" value="{{$emp->br_id}}.{{$emp->address}}" name="br" placeholder="" disabled>                            
                        </div>
                        <label for="gender">Ca làm </label>
                        <select class="form-control input-lg m-bot15" name="shift" required>                            
                            @foreach($shift as $key => $s)
                            <option value={{$s->shift_id}}>Ca {{$s->shift_id}}. Từ {{substr($s->start,0,5)}} giờ đến {{substr($s->end,0,5)}} giờ</option>
                            @endforeach
                        </select>
                        <div class="checkbox">
                            @foreach($weekday as $key => $day)
                            <label>
                                <input type="checkbox" name="day[]" value={{$day->id}}>{{$day->day2}}
                            </label>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="position">Vị trí </label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="position" value="cook" checked>
                                    Bếp
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="position" value="chef">
                                    Bếp trưởng
                                </label>
                            </div>                            
                            <div class="radio">
                                <label>
                                    <input type="radio" name="position" value="waiter" >
                                    Phục vụ
                                </label>
                            </div>
                            <?php if($emp->role=="manager") { ?>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="position" value="manager" checked>
                                    Quản lý
                                </label>
                            </div>
                            <?php } ?>
                        </div>
                        <button type="submit" name="editwork" class="btn btn-info">Thêm</button>                    
                    </form>
                </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
