<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();

class Employee extends Controller
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
    public function add_emp(){
        $this->AuthLogin();
        $br=DB::table('tb1_branch')->orderby('br_id','desc')->get();
        return view('admin.employee.add_employee')->with('br_id',$br);
    }
    public function all_emp($br){
        $this->AuthLogin();
        if($br!='all'){
            $all_employee=DB::table('tb1_employee')->join('tb1_branch','tb1_employee.br_id','=','tb1_branch.br_id')->where('tb1_employee.br_id',$br)->get();
        }
        else{
            $all_employee=DB::table('tb1_employee')->join('tb1_branch','tb1_employee.br_id','=','tb1_branch.br_id')->get();
        }        
        $employee=view('admin.employee.all_employee')->with('all_employee',$all_employee);
        return view('admin_layout')->with('admin.employee.all_employee',$employee);
    }
    public function save_emp(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['br_id']=$request->br;
        $data['emp_name']=$request->name;
        $data['gender']=$request->gender;
        $data['emp_phone']=$request->phone;
        $data['emp_pid']=$request->pid;
        DB::table('tb1_employee')->insert($data);
        Session::put('message', 'Đã thêm nhân viên');
        return Redirect::to('add-employee');
    }
    public function edit_emp($emp_id){
        $this->AuthLogin();
        $edit_employee=DB::table('tb1_employee')->join('tb1_branch','tb1_employee.br_id','=','tb1_branch.br_id')->where('emp_id',$emp_id)->get();
        $br=DB::table('tb1_branch')->get();
        $employee=view('admin.employee.edit_employee')->with('edit_employee',$edit_employee)->with('branch',$br);
        return view('admin_layout')->with('admin.employee.edit_employee',$employee);
    }
    public function upd_emp(Request $request,$emp_id){
        $this->AuthLogin();
        $data = array();        
        $branch=$request->br;
        if($branch){
            $data['br_id']=$branch;
        }        
        $data['emp_name']=$request->name;
        $data['gender']=$request->gender;
        $data['emp_phone']=$request->phone;
        $data['emp_pid']=$request->pid;
        DB::table('tb1_employee')->where('emp_id',$emp_id)->update($data);        
        Session::put('message', 'Đã sửa nhân viên');
        $brch=Session::get('br');
        if($brch){
            return Redirect::to('all-employee/'.$brch);
        }else {
            return Redirect::to('all-employee/all');
        }
    }
    public function del_emp($emp_id){
        $this->AuthLogin();
        DB::table('tb1_employee')->where('emp_id',$emp_id)->delete();
        Session::put('message', 'Đã xóa nhân viên');
        $brch=Session::get('br');
        if($brch){
            return Redirect::to('all-employee/'.$brch);
        }else {
            return Redirect::to('all-employee/all');
        }
    }
    public function promote($emp_id){      
        $this->AuthLogin();          
        DB::table('tb1_employee')->where('emp_id',$emp_id)->update(['role'=>'manager']);
        $info=DB::table('tb1_employee')->where('emp_id',$emp_id)->first();        
        $data = array();
        $data['emp_id']=$emp_id;
        $data['password']=md5('123');
        DB::table('tb1_manager_account')->insert($data);
        Session::put('message', 'Đã thăng chức nhân viên lên quản lý');
        return Redirect::to('all-employee/all');
    }
    public function demote($emp_id){
        $this->AuthLogin();
        DB::table('tb1_employee')->where('emp_id',$emp_id)->update(['role'=>'employee']);
        DB::table('tb1_manager_account')->where('emp_id',$emp_id)->delete();
        Session::put('message', 'Đã thay đổi chức vụ');
        return Redirect::to('all-employee/all');
    }
}
