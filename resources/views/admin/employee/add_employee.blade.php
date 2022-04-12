@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm nhân viên
            </header>
            <div class="panel-body">
                <?php
                $msg=Session::get('message');
                $brch=Session::get('br');
                if($msg)	{
                    echo $msg;
                    Session::put('message',null);
                }
                ?>
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-employee')}}" method="post">
                        {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">Tên nhân viên </label>
                        <input type="text" class="form-control" name="name" placeholder="" required>
                    </div>
                    <label for="br">Chi nhánh </label>
                    <select class="form-control input-lg m-bot15" name="br" <?php if($brch) echo 'disabled' ?>>
                        @foreach($br_id as $key => $br)                        
                        <option <?php if($brch==$br->br_id) echo 'selected' ?> value={{$br->br_id}}>{{$br->address}}</option>
                        @endforeach
                    </select>
                    <label for="gender">Giới tính </label>
                    <select class="form-control input-lg m-bot15" name="gender">
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>                        
                    </select>
                    <div class="form-group">
                        <label for="phone">Số điện thoại </label>
                        <input type="text" class="form-control" name="phone" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="pid">Số CCCD </label>
                        <input type="text" class="form-control" name="pid" placeholder="" required>
                    </div>                    
                    <button type="submit" name="add_employee" class="btn btn-info">Thêm</button>
                </form>
                </div>
            </div>
        </section>
    </div>
@endsection
