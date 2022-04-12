@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm chi nhánh
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
                    <form role="form" action="{{URL::to('/save-branch')}}" method="post">
                        {{csrf_field()}}
                    <div class="form-group">
                        <label for="address">Địa chỉ </label>
                        <input type="text" class="form-control" name="address" placeholder="Địa chỉ chi nhánh" required>
                    </div>                    
                    <button type="submit" name="add_branch" class="btn btn-info">Thêm</button>
                </form>
                </div>
            </div>
        </section>
    </div>
@endsection
