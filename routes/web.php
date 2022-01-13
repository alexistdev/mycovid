<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{DashboardController as DashAdmin,PenyakitController as PenyAdmin};

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

Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['web','auth','roles']],function() {
    Route::group(['roles' => 'admin'], function () {
        Route::get('/admin/dashboard', [DashAdmin::class, 'index'])->name('admin.dashboard');

        Route::get('/admin/penyakit', [PenyAdmin::class, 'index'])->name('admin.penyakit');
        Route::post('/admin/penyakit', [PenyAdmin::class, 'store'])->name('admin.savepenyakit');
        Route::patch('/admin/penyakit', [PenyAdmin::class, 'update'])->name('admin.updatepenyakit');
        Route::delete('/admin/penyakit', [PenyAdmin::class, 'destroy'])->name('admin.deletepenyakit');
        Route::get('/admin/penyakit/add', [PenyAdmin::class, 'create'])->name('admin.addpenyakit');
        Route::get('/admin/penyakit/{id}/edit', [PenyAdmin::class, 'edit'])->name('admin.editpenyakit');
    });
});

require __DIR__.'/auth.php';
