@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                đổi mật khẩu
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
                    <form role="form" action="{{URL::to('/save-password')}}" method="post">
                        {{csrf_field()}}                    
                    <div class="form-group">
                        <label for="address">Mật khẩu cũ</label>
                        <input type="password" class="form-control" name="old" placeholder="Mật khẩu cũ" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Mật khẩu mới</label>
                        <input type="password" class="form-control" name="new" placeholder="Mật khẩu mới" required>
                    </div>
                    <button type="submit" name="add_branch" class="btn btn-info">Đổi mật khẩu</button>
                </form>
                </div>
            </div>
        </section>
    </div>
@endsection
