<?php

namespace App\Http\Controllers;
use DateTime;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();
class Attendance extends Controller
{
    public function AuthEmp(){
        $emp=Session::get('employee');
        if($emp){
            return Redirect::to('empboard');
        }
        else{
            Redirect::to('nhanvien')->send();
        }
    }
    public function get_time(){
        $dat = new DateTime();
        $now=($dat->format('H:i'));
        return $now;
    }
    public function get_date(){
        $dat = new DateTime();
        $now=($dat->format('Y/m/d '));
        return $now;
    }
    public function index(){
        $emp=Session::get('employee');
        if($emp){
            return view('emp.dashboard');
        }else{
            return view('emp.emp_login');
        }
    }
    public function show_dashboard(){
        $this->AuthEmp();
        return view('emp.dashboard');
    }
    public function dashboard(Request $request){
        $emp = $request->emp_id;
        $employee = DB::table('tb1_employee')->where('emp_id',$emp)->first();
        if($employee){            
            Session::put('employee',$employee->emp_name);
            Session::put('branch',$employee->br_id);
            Session::put('emp_id',$emp);
            return Redirect::to('/nhan-vien');
        }
        else {
            Session::put('message','Sai mã nhân viên');
            return Redirect::to('/nhanvien');
        }
    }
    public function logout(){
        $this->AuthEmp();
        Session::put('employee',null);
        return Redirect::to('/nhanvien');
    }
    public function view_work(){
        $this->AuthEmp();
        $emp_id=Session::get('emp_id');
        $work=DB::table('tb1_work')->where('emp_id',$emp_id)->get();
        $weekday=DB::table('tb1_weekday')->get();
        $shift=DB::table('tb1_shift')->get();
        $br=Session::get('branch');
        $branch=DB::table('tb1_branch')->where('br_id',$br)->first();
        $pos=DB::table('tb1_work_position')->get();
        return view('emp.all_work')->with('work',$work)->with('weekday',$weekday)->with('shift',$shift)->with('branch',$branch)->with('position',$pos);
    }
    public function attend(){
        $this->AuthEmp();
        $emp_id=Session::get('emp_id');
        $dat = new DateTime(); 
        $date=($dat->format( 'N' )+1);
        $work=DB::table('tb1_work')->join('tb1_branch','tb1_branch.br_id','=','tb1_work.br_id')->join('tb1_work_position','tb1_work_position.eng','=','tb1_work.position')->where('emp_id',$emp_id)->where('day',$date)->get();
        $shift=DB::table('tb1_shift')->get();
        return view('emp.attend')->with('shift',$shift)->with('work',$work);
    }
    public function chk_shift(){
        $now=$this->get_time();
        $shift=DB::table('tb1_shift')->orderby('end','desc')->get();
        $id=0;
        foreach($shift as $sh){
            if($now<=$sh->end&&$now>=$sh->start_attend) $id=$sh->shift_id;
        }
        return $id;
    }
    public function checkin(Request $request){
        $this->AuthEmp();
        $now=$this->get_time();
        $date=$this->get_date();
        $shift=$this->chk_shift();
        if($shift!=0){
            $data['emp_id']=Session::get('emp_id');
            $data['br_id']=Session::get('branch');
            $data['checkin']=$now;
            $data['shift_id']=$shift;
            $data['date']=$date;
            $start=DB::table('tb1_shift')->where('shift_id',$shift)->first();
            if($now>=$start->start_attend&&$now<=$start->start){
                $data['result']='on time';
            }else{
                $data['result']='late';
            }
            try{
                DB::table('tb1_attendance')->insert($data);
                Session::put('message', 'Đã checkin');
            }
             catch(QueryException $e) {
                 Session::put('message', 'Đã checkin trước');
            }
        }else{
            Session::put('message','Chưa đến giờ làm việc');
        }
        return back();
    }
    public function checkout(){
        $this->AuthEmp();
        $now=$this->get_time();
        $date=$this->get_date();
        $sh=DB::table('tb1_shift')->get();
        foreach($sh as $sh){
            if($now>=$sh->start){
                $shift=$sh->shift_id;
            }
        }
        try{
            $emp_id=Session::get('emp_id');
            $br_id=Session::get('branch');
            DB::table('tb1_attendance')->where('emp_id',$emp_id)->where('br_id',$br_id)->where('date',$date)->where('shift_id',$shift)->limit(1)->update(['checkout' => $now]);
            $this->atd_result($emp_id,$br_id,$shift,$date);
            Session::put('message', 'Đã checkout');
        }
        catch(QueryException $e) {
            Session::put('message', 'Chưa checkin');
        }
        return back();
    }
    public function atd_result($emp,$br,$shift,$date){
        $atd=DB::table('tb1_attendance')->where('emp_id',$emp)->where('br_id',$br)->where('shift_id',$shift)->where('date',$date)->first();
        $ckin=strtotime($atd->checkin);
        $ckout=strtotime($atd->checkout);
        $sh=DB::table('tb1_shift')->where('shift_id',$shift)->first();
        $end=strtotime($sh->end);
        $start=strtotime($sh->start);
        if($atd->result=='on time'){
            if($ckout<$end){
                $data['result']='early leave';
                $data['duration']=round(($ckout-$start)/3600,2);
            }else{
                $data['result']='full';
                $data['duration']=5;
            }
        }else{
            if($ckout<$end){
                $data['duration']=round(($ckout-$ckin)/3600,2);
            }else{
                $data['duration']=round(($end-$ckin)/3600, 2);
            }
        }
        DB::table('tb1_attendance')->where('emp_id',$emp)->where('br_id',$br)->where('date',$date)->where('shift_id',$shift)->limit(1)->update($data);
    }
}