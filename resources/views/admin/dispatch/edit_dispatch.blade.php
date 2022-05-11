@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-3">
        <section class="panel">
            <table class="table table-striped b-t b-light">                
                <tbody>
                  <tr>
                    <th>Chi nhánh</th>
                    <td>{{$dispatch->br_id}}</td>
                  </tr>
                  <tr>
                    <th>Ngày</th>
                    <td>{{$dispatch->date}}</td>
                  </tr>
                  <tr>
                    <th>Ca</th>
                    <td>{{$dispatch->shift_id}}</td>
                  </tr>
                  <tr>
                    <th>Vị trí</th>
                    <td>@foreach($pos as $ps)
                      <?php if(str_contains($dispatch->position,$ps->eng)) echo $ps->vie.'<br>' ?>
                    @endforeach</td>
                  </tr>
                  <tr>
                    <th>Ghi chú</th>
                    <td>{{$dispatch->note}}</td>
                  </tr>
                </tbody>
              </table>
        </section>
    </div>
    <div class="col-lg-9">
        <form role="form" action="{{URL::to('/upd-dispatch/')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="dp" value={{$dispatch->dp_id}}>
            <section class="panel">
                <header class="panel-heading">
                    danh sách nhân viên
                </header>
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Tên</th>
                            <th>Chi nhánh</th>
                            <th>Chức vụ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($emp as $emp)
                        <tr>
                            <td>{{$emp->emp_id}}</td>
                            <td>{{$emp->emp_name}}</td>
                            <td>{{$emp->br_id}}</td>
                            <td><?php if($emp->role=="employee") echo 'Nhân viên'; else echo 'Quản lý'; ?></td>
                            <td><input type="checkbox" name="emp[]" value={{$emp->emp_id}}></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="panel-body">
                    <button type="submit" name="add_branch" class="btn btn-info">Xác nhận</button>
                </div>
            </section>
        </form>
    </div>
@endsection
