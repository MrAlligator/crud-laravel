<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductAjaxController;
use App\Models\Employee;

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

Route::get('/', function () {
    return view('content.dashboard', [
        'title' => 'CRUD Datatables',
        'subTitle' => 'Dashboard',
    ]);
    // var_dump(Employee::all());
    // var_dump(
    //     Employee::updateOrCreate(
    //         ['id' => '4'],
    //         [
    //             'employerName' => 'Bambang',
    //             'employerNIK' => 'MGF22100211',
    //             'employerPosition' => 'Staff',
    //             'employerDepartment' => 'MIS',
    //             'employerAddress' => 'Wiyung',
    //         ],
    //     ),
    // );
    // die();
});

Route::get('/auth', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::resource('ajaxproducts', ProductAjaxController::class);

Route::resource('ajaxemployee', EmployeeController::class);