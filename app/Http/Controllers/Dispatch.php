<?php

namespace App\Http\Controllers;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();

class Dispatch extends Controller
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
    public function add_dispatch(){        
        $this->AuthLogin();
        $br_id=Session::get('br');
        $br=DB::table('tb1_branch')->where('br_id',$br_id)->first();
        $shift=DB::table('tb1_shift')->get();
        return view('admin.dispatch.add_dispatch')->with('br',$br)->with('shift',$shift);
    }
    public function save_dispatch(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['br_id']=$request->br;
        $data['date']=$request->date;
        $pos=$request->pos;
        $data['position']=implode(" ",$pos);
        $data['note']=$request->note;
        foreach($request->shift as $shift){
            $data['shift_id']=$shift;
            DB::table('tb1_dispatcher')->insert($data);
        }        
        Session::put('message', 'Đã gửi yêu cầu');
        return Redirect::to('/all-work');
    }
    public function all_dispatch(){
        $this->AuthLogin();
        $dp=DB::table('tb1_dispatcher')->join('tb1_branch','tb1_branch.br_id','=','tb1_dispatcher.br_id')->get();
        $pos=DB::table('tb1_work_position')->get();
        $emp=DB::table('tb1_dispatched_employee')->get();
        return view('admin.dispatch.all_dispatch')->with('dispatch',$dp)->with('pos',$pos)->with('emp',$emp);
    }
    public function edit_dispatch($dp){
        $this->AuthLogin();
        $dp=DB::table('tb1_dispatcher')->where('dp_id',$dp)->first();        
        $date=Datetime::createFromFormat('Y-m-d',$dp->date);
        $dat=($date->format( 'N' )+1);
        $shift=$dp->shift_id;
        $br=$dp->br_id;
        $worked_br=DB::table('tb1_work')->where('br_id',$br)->pluck('emp_id');
        $worked_sh=DB::table('tb1_work')->where('day',$dat)->where('shift_id',$shift)->pluck('emp_id');
        $emp=DB::table('tb1_employee')->whereNotIn('emp_id',$worked_br)->whereNotIn('emp_id',$worked_sh)->get();
        $pos=DB::table('tb1_work_position')->get();
        return view('admin.dispatch.edit_dispatch')->with('dispatch',$dp)->with('emp',$emp)->with('pos',$pos);
    }
    public function upd_dispatch(Request $request){
        $this->AuthLogin();
        $dp=DB::table('tb1_dispatcher')->where('dp_id',$request->dp)->first();
        $att = array();
        $att['br_id']=$dp->br_id;
        $att['shift_id']=$dp->shift_id;
        $att['date']=$dp->date;
        $att['result']='overtime';
        $data = array();
        $data['dp_id']=$request->dp;
        $emp=$request->emp;
        $num=0;
        foreach($emp as $emp){
            $data['emp_id']=$emp;
            DB::table('tb1_dispatched_employee')->insert($data);
            $att['emp_id']=$emp;
            DB::table('tb1_attendance')->insert($att);
            $num++;
        }
        DB::table('tb1_dispatcher')->where('dp_id',$request->dp)->update(['result' => 'solved','emp' => $num]);
        Session::put('message', 'Đã gửi yêu cầu');
        return Redirect::to('/all-dispatch');
    }
}
