@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật chi nhánh
            </header>
            <div class="panel-body">
                <?php
                $brch=Session::get('br');
                $msg=Session::get('message');
                $admin=Session::get('ad_id');
                if($msg)	{
                    echo $msg;
                    Session::put('message',null);
                }                
                ?>
                @foreach($edit_employee as $key => $edit)
                <div class="position-center">
                    <form role="form" action="{{URL::to('/upd-employee/'.$edit->emp_id)}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">Tên nhân viên </label>
                            <input type="text" class="form-control" value="{{$edit->emp_name}}" name="name" placeholder="" required>
                        </div>
                        <label for="br">Chi nhánh </label>
                        <select class="form-control input-lg m-bot15" name="br" <?php if($brch) echo 'disabled' ?>>
                            @foreach($branch as $key => $br)                        
                            <option value={{$br->br_id}} <?php if($br->br_id==$edit->br_id) echo "selected"; ?>>{{$br->address}}</option>
                            @endforeach
                        </select>
                        <label for="gender">Giới tính </label>
                        <select class="form-control input-lg m-bot15" name="gender">
                            <option value="Nam" <?php if($edit->gender=="Nam") echo "selected"; ?>>Nam</option>
                            <option value="Nữ" <?php if($edit->gender=="Nữ") echo "selected"; ?>>Nữ</option>                        
                        </select>
                        <div class="form-group">
                            <label for="phone">Số điện thoại </label>
                            <input type="text" class="form-control" value="{{$edit->emp_phone}}" name="phone" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="pid">Số CCCD </label>
                            <input type="text" class="form-control" value="{{$edit->emp_pid}}" name="pid" placeholder="" required>
                        </div>                               
                    <button type="submit" name="add_branch" class="btn btn-info">Sửa</button>
                    <?php                    
                    if($admin){
                        if($edit->role=="employee"){ ?>
                        <a href="{{URL::to('/promote/'.$edit->emp_id)}}"class="btn btn-success">Thăng chức</a>
                    <?php }
                    else{ ?>
                        <a href="{{URL::to('/demote/'.$edit->emp_id)}}" class="btn btn-danger">Cách chức</a>'
                    <?php }} ?>
                </form>
                </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
