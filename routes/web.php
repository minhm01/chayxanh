<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Attendance;
use App\Http\Controllers\branch;
use App\Http\Controllers\Dispatch;
use App\Http\Controllers\Employee;
use App\Http\Controllers\Manager;
use App\Http\Controllers\Work;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Frontend
Route::get('/', 'HomeController@index');

//Backend
Route::get('/quanly', 'AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashboard');
Route::post('/admin-dashboard', 'AdminController@dashboard');
Route::get('/logout', 'AdminController@logout');
Route::get('/change-password', 'AdminController@change_pw');
Route::post('/save-password', 'AdminController@save_pw');

//Branch
Route::get('/add-branch', 'Branch@add_branch');
Route::get('/all-branch', 'Branch@all_branch');
Route::post('/save-branch', 'Branch@save_branch');
Route::get('/edit-branch/{br_id}', 'Branch@edit_branch');
Route::post('/upd-branch/{br_id}', 'Branch@upd_branch');
Route::get('/del-branch/{br_id}', 'Branch@del_branch');

//Employee
Route::get('/add-employee', 'Employee@add_emp');
Route::get('/all-employee', 'Employee@all_emp');
Route::post('/save-employee', 'Employee@save_emp');
Route::get('/edit-employee/{emp_id}', 'Employee@edit_emp');
Route::post('/upd-employee/{emp_id}', 'Employee@upd_emp');
Route::get('/del-employee/{emp_id}', 'Employee@del_emp');
Route::get('/promote/{emp_id}', 'Employee@promote');
Route::get('/demote/{emp_id}', 'Employee@demote');

//Work
Route::get('/add-work/{emp_id}','Work@add_work');
Route::post('/save-work', 'Work@save_work');
Route::get('/all-work', 'Work@all_work');

//Attendance
Route::get('/nhanvien', 'Attendance@index');
Route::get('/nhan-vien', 'Attendance@show_dashboard');
Route::post('/emp-dashboard', 'Attendance@dashboard');
Route::get('/emp-logout', 'Attendance@logout');
Route::get('/xemlich', 'Attendance@view_work');
Route::get('/chamcong', 'Attendance@attend');
Route::post('/checkin', 'Attendance@checkin');
Route::get('/checkout', 'Attendance@checkout');
Route::get('/all-attend', 'Attendance@all_attend');

//Dispatch
Route::get('/request-dispatch', 'Dispatch@add_dispatch');
Route::post('/save-dispatch', 'Dispatch@save_dispatch');
Route::get('/all-dispatch', 'Dispatch@all_dispatch');
Route::get('/send-dispatch/{dp_id}', 'Dispatch@edit_dispatch');
Route::post('/upd-dispatch', 'Dispatch@upd_dispatch');