<?php
  
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BranchController;



  
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
  
// Route::get('/', function () {
//     return view('Brands.list');
// });
Route::get('/', [BrandController::class, 'list'])->name('brands.list');
Route::get('/brands/{id}', [BrandController::class, 'showbrand'])->name('brand.show');
Route::get('/branches/{id}', [BranchController::class, 'showbranch'])->name('branches.show');

  
Auth::routes();
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('branches', BranchController::class);
    Route::get('/branches/create/{id}', [BranchController::class, 'create'])->name('branches.create');

});