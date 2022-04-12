<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


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

//Branch
Route::get('/add-branch', 'Branch@add_branch');
Route::get('/all-branch', 'Branch@all_branch');
Route::post('/save-branch', 'Branch@save_branch');
Route::get('/edit-branch/{br_id}', 'Branch@edit_branch');
Route::post('/upd-branch/{br_id}', 'Branch@upd_branch');
Route::get('/del-branch/{br_id}', 'Branch@del_branch');

//Employee
Route::get('/add-employee', 'Employee@add_emp');
Route::get('/all-employee/{br}', 'Employee@all_emp');
Route::post('/save-employee', 'Employee@save_emp');
Route::get('/edit-employee/{emp_id}', 'Employee@edit_emp');
Route::post('/upd-employee/{emp_id}', 'Employee@upd_emp');
Route::get('/del-employee/{emp_id}', 'Employee@del_emp');
Route::get('/promote/{emp_id}', 'Employee@promote');
Route::get('/demote/{emp_id}', 'Employee@demote');

//Work
Route::get('edit-work/{emp_id}','Work@edit_work');

//Attendance