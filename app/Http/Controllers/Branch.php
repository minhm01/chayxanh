<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();

class Branch extends Controller
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
    public function add_branch(){
        $this->AuthLogin();
        return view('admin.branch.add_branch');
    }
    public function all_branch(){
        $this->AuthLogin();
        $all_branch=DB::table('tb1_branch')->get();
        $branch=view('admin.branch.all_branch')->with('all_branch',$all_branch);
        return view('admin_layout')->with('admin.branch.all_branch',$branch);
    }
    public function save_branch(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['address']=$request->address;
        DB::table('tb1_branch')->insert($data);
        Session::put('message', 'Đã thêm chi nhánh');
        return Redirect::to('add-branch');
    }
    public function edit_branch($br_id){
        $this->AuthLogin();
        $edit_branch=DB::table('tb1_branch')->where('br_id',$br_id)->get();
        $branch=view('admin.branch.edit_branch')->with('edit_branch',$edit_branch);
        return view('admin_layout')->with('admin.branch.edit_branch',$branch);
    }
    public function upd_branch(Request $request,$br_id){
        $this->AuthLogin();
        $data = array();        
        $data['address']=$request->address;
        DB::table('tb1_branch')->where('br_id',$br_id)->update($data);        
        Session::put('message', 'Đã sửa chi nhánh');
        return Redirect::to('all-branch');
    }
    public function del_branch($br_id){
        $this->AuthLogin();
        DB::table('tb1_branch')->where('br_id',$br_id)->delete();        
        Session::put('message', 'Đã xóa chi nhánh');
        return Redirect::to('all-branch');
    }
}
