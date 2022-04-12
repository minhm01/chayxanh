<?php

namespace App\Http\Controllers;

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
    public function edit_work($emp_id){
        $this->AuthLogin();
        $employee=DB::table('tb1_employee')->join('tb1_branch','tb1_employee.br_id','=','tb1_branch.br_id')->where('emp_id',$emp_id)->get();        
        $weekday=DB::table('tb1_weekday')->get();
        $shift=DB::table('tb1_shift')->get();
        return view('admin.work.edit_work')->with('employee',$employee)->with('weekday',$weekday)->with('shift',$shift);
    }
}
