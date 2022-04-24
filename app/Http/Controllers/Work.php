<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();
class Work extends Controller
{
    public function AuthLogin(){
        $admin=Session::get('ad_id');
        $manager=Session::get('manager');
        if($admin||$manager){
            return Redirect::to('dashboard');
        }
        else{
            Redirect::to('quanly')->send();
        }
    }
    public function add_work($emp_id){
        $this->AuthLogin();
        $employee=DB::table('tb1_employee')->join('tb1_branch','tb1_employee.br_id','=','tb1_branch.br_id')->where('emp_id',$emp_id)->get();
        $weekday=DB::table('tb1_weekday')->get();
        $shift=DB::table('tb1_shift')->get();
        return view('admin.work.add_work')->with('employee',$employee)->with('weekday',$weekday)->with('shift',$shift);
    }
    public function save_work(Request $request){
        $this->AuthLogin();
        try{
            $data = array();
            $data['emp_id']=$request->id;
            $data['shift_id']=$request->shift;
            $data['br_id']=$request->branch;
            $data['position']=$request->position;
            foreach($request->day as $key => $day){
                $data['day']=$day;
                DB::table('tb1_work')->insert($data);
            }
            Session::put('message', 'Đã xếp lịch làm việc');
            $admin=Session::get('ad_id');
            $manager=Session::get('br');        
            if($admin){
                return Redirect::to('all-employee/all');
            }
            else{
                return Redirect::to('all-employee/'.$manager);
            }
        }
        catch(QueryException $e) {
            Session::put('message', 'Trùng lịch');
            return back();
        }
    }
    public function all_work(){
        $this->AuthLogin();
        $branch=DB::table('tb1_branch')->get();
        $week=DB::table('tb1_weekday')->get();
        $shift=DB::table('tb1_shift')->get();
        $work=DB::table('tb1_employee')->join('tb1_work','tb1_employee.emp_id','=','tb1_work.emp_id')->get();
        $pos=DB::table('tb1_work_position')->get();
        return view('admin.work.all_work')->with('branch',$branch)->with('week',$week)->with('shift',$shift)->with('work',$work)->with('position',$pos);
    }
}
