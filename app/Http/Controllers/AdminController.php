<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();
class AdminController extends Controller
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
    public function index(){
        $admin=Session::get('ad_id');
        $manager=Session::get('manager');
        if($admin||$manager){
            return view('admin.dashboard');
        }else{
            return view('admin_login');
        }        
    }
    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        $user = $request->ad_user;
        $pass = md5($request->ad_pass);
        $admin = DB::table('tb1_admin')->where('admin_user',$user)->where('password',$pass)->first();
        $manager = DB::table('tb1_manager_account')->where('emp_id',$user)->where('password',$pass)->first();
        if($admin){
            Session::put('ad_user',$admin->admin_user);
            Session::put('ad_id',$admin->admin_id);
            return Redirect::to('/dashboard');
        }
        elseif($manager){
            $info=DB::table('tb1_employee')->where('emp_id',$user)->first();
            Session::put('manager',$info->emp_name);
            Session::put('br',$info->br_id);
            return Redirect::to('/dashboard');
        }
        else {
            Session::put('message','Đăng nhập thất bại');
            return Redirect::to('/quanly');
        }
    }
    public function logout(){
        $this->AuthLogin();
        Session::put('ad_user',null);
        Session::put('ad_id',null);
        Session::put('manager',null);
        Session::put('br',null);
        return Redirect::to('/quanly');
    }
}

