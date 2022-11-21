<?php

use App\Models\Items;
use App\Models\Account;
use App\Models\SOModel;
use App\Models\Employee;
use App\Models\SODetail;
use App\Models\SOHeader;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SOController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SOHeaderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductAjaxController;

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
// Route::resource('ajaxemployee', EmployeeController::class)->middleware('auth');
// Route::resource('ajaxproducts', ProductAjaxController::class)->middleware('auth');

Route::get('/check', function () {

    // return view('layout.check');
    // var_dump(DB::table('s_o_headers')->where('sonumber', '23563647')->get());
    // dd(SODetail::where('sonumber', 'SO1668920007')->count());
    // dd(Hash::make('admin'));
    // SODetail::where('noid', 1)->update([
    //     'qty' => 20,
    // ]);
    // $cek = SOHeader::all();
    // $cek = Http::get('http://akses.kokola.co.id/api/magnetar/customer.php');
    // $response = Http::get('http://akses.kokola.co.id/api/magnetar/customer.php');
    // dd($response);
    // $a = 'hahaha^hihihi^huhuhu';
    // $item = $a;
    // $iteminput = explode('^', $item, 3);
    // $cek = $iteminput[0];
    // dd($cek);
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
    // SOHeader::create(
    //     [
    //         'tanggal' => '2022-11-21',
    //         'accountid' => '1766278987',
    //     ]
    // );
    // $a = 'hahaha^hihihi^huhuhu';
    // $item = $a;
    // $iteminput = explode('^', $item, 3);
    // $cek = $iteminput[0];
    // SODetail::create(
    //     [
    //         'soid' => 1,
    //         'itemid' => 1,
    //         'itemcode' => '$itemcode',
    //         'itemname' => $cek,
    //         'qty' => 10,
    //         'price' => 10000,
    //         'discount' => 0,
    //         'total' => 100000,
    //     ]
    // );
});

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

//Login & Logout
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.action');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

//Opt Load
Route::get('accopt/{id}/show', [AccountController::class, 'show'])->name('opt.load.acc')->middleware('auth');
Route::get('itemopt/{id}', [ItemsController::class, 'show'])->name('opt.load.item')->middleware('auth');

Route::get('solist', [SOController::class, 'index'])->name('solist')->middleware('auth');
Route::post('savesoheader', [SOController::class, 'saveSOHeader'])->name('save.soheader')->middleware('auth');
Route::get('addsodetail/{soID}/add', [SOController::class, 'addSODetail'])->name('add.sodetail')->middleware('auth');
Route::get('addsodetail/{soID}/edit', [SOController::class, 'editSODetail'])->name('edit.sodetail')->middleware('auth');
Route::post('savesodetail', [SOController::class, 'saveSODetail'])->name('save.sodetail')->middleware('auth');
Route::post('updatesodetail', [SOController::class, 'updateSODetail'])->name('update.sodetail')->middleware('auth');