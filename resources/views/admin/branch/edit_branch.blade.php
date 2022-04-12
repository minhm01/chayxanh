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
                $msg=Session::get('message');
                if($msg)	{
                    echo $msg;
                    Session::put('message',null);
                }
                ?>
                @foreach($edit_branch as $key => $edit)
                <div class="position-center">
                    <form role="form" action="{{URL::to('/upd-branch/'.$edit->br_id)}}" method="post">
                        {{csrf_field()}}
                    <div class="form-group">
                        <label for="address">Địa chỉ </label>
                        <input type="text" value="{{$edit->address}}" class="form-control" name="address" placeholder="Địa chỉ chi nhánh" required>
                    </div>                    
                    <button type="submit" name="add_branch" class="btn btn-info">Sửa</button>
                </form>
                </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
