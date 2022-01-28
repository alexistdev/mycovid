<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{DashboardController as DashAdmin,PenyakitController as PenyAdmin,GejalaController as GejAdmin,RuleController as RuleAdmin};
use App\Http\Controllers\User\{DashboardController as DashUser};

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

        Route::get('/admin/rule', [RuleAdmin::class, 'index'])->name('admin.rule');

        Route::get('/admin/gejala', [GejAdmin::class, 'index'])->name('admin.gejala');
        Route::post('/admin/gejala', [GejAdmin::class, 'store'])->name('admin.savegejala');
        Route::patch('/admin/gejala', [GejAdmin::class, 'update'])->name('admin.updategejala');
        Route::delete('/admin/gejala', [GejAdmin::class, 'destroy'])->name('admin.deletegejala');
        Route::get('/admin/gejala/add', [GejAdmin::class, 'create'])->name('admin.addgejala');
        Route::get('/admin/gejala/{id}/edit', [GejAdmin::class, 'edit'])->name('admin.editgejala');



        Route::get('/admin/penyakit', [PenyAdmin::class, 'index'])->name('admin.penyakit');
        Route::post('/admin/penyakit', [PenyAdmin::class, 'store'])->name('admin.savepenyakit');
        Route::patch('/admin/penyakit', [PenyAdmin::class, 'update'])->name('admin.updatepenyakit');
        Route::delete('/admin/penyakit', [PenyAdmin::class, 'destroy'])->name('admin.deletepenyakit');
        Route::get('/admin/penyakit/add', [PenyAdmin::class, 'create'])->name('admin.addpenyakit');
        Route::get('/admin/penyakit/{id}/edit', [DashAdmin::class, 'edit'])->name('admin.editpenyakit');

        Route::get('/admin/test', [DashAdmin::class, 'test'])->name('admin.test');
    });

    Route::group(['roles' => 'user'], function () {
        Route::get('/user/dashboard', [DashUser::class, 'index'])->name('user.dashboard');
    });
});

require __DIR__.'/auth.php';
