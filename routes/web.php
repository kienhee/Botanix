<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Category\CategoryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Group\GroupController;
use App\Http\Controllers\Admin\Project\ProjectController;
use App\Http\Controllers\Admin\Trend\TrendController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\ClientController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/')->name('client.')->group(function () {
    Route::get("/", [ClientController::class, 'home'])->name('index');
    Route::prefix('/project')->group(function () {
        Route::get("/", [ClientController::class, 'project'])->name('project');
        Route::get("/{slug}", [ClientController::class, 'detail'])->name('project-detail');
    });
    Route::prefix('/submit')->group(function () {
        Route::get("/", [ClientController::class, 'submit'])->name('submit');
        Route::post("/", [ClientController::class, 'postSubmit'])->name('post-submit');
        Route::get("/success", [ClientController::class, 'submitSuccess'])->name('submit-success');
        Route::get("/failed", [ClientController::class, 'submitFailed'])->name('submit-failed');
    });
});
Route::prefix('/dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, "dashboard"])->name('index');
    // Quản lý danh mục
    Route::prefix('categories')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/add', [categoryController::class, 'add'])->name('add');
        Route::post('/add', [categoryController::class, 'store'])->name('store');
        Route::get('/edit/{category}', [categoryController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [categoryController::class, 'update'])->name('update');
        Route::delete('/soft-delete/{id}', [categoryController::class, 'softDelete'])->name('soft-delete');
        Route::delete('/force-delete/{id}', [categoryController::class, 'forceDelete'])->name('force-delete');
        Route::delete('/restore/{id}', [categoryController::class, 'restore'])->name('restore');
    });
    Route::prefix('trendings')->name('trending.')->group(function () {
        Route::get('/', [TrendController::class, 'index'])->name('index');
        Route::get('/add', [TrendController::class, 'add'])->name('add');
        Route::post('/add', [TrendController::class, 'store'])->name('store');
        Route::get('/edit/{trending}', [TrendController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [TrendController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [TrendController::class, 'delete'])->name('delete');
    });
    Route::prefix('projects')->name('project.')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/add', [ProjectController::class, 'add'])->name('add');
        Route::post('/add', [ProjectController::class, 'store'])->name('store');
        Route::get('/edit/{project}', [ProjectController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [ProjectController::class, 'update'])->name('update');
        Route::delete('/soft-delete/{id}', [ProjectController::class, 'softDelete'])->name('soft-delete');
        Route::delete('/force-delete/{id}', [ProjectController::class, 'forceDelete'])->name('force-delete');
        Route::delete('/restore/{id}', [ProjectController::class, 'restore'])->name('restore');
    });

    Route::prefix('groups')->name('group.')->group(function () {
        Route::get('/', [GroupController::class, 'index'])->name('index');
        Route::get('/add', [GroupController::class, 'add'])->name('add');
        Route::post('/add', [GroupController::class, 'store'])->name('store');
        Route::get('/edit/{group}', [GroupController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [GroupController::class, 'update'])->name('update');

        Route::delete('/delete/{id}', [GroupController::class, 'delete'])->name('delete');
    });
    Route::prefix('users')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/add', [UserController::class, 'add'])->name('add');
        Route::post('/add', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/soft-delete/{id}', [UserController::class, 'softDelete'])->name('soft-delete');
        Route::delete('/force-delete/{id}', [UserController::class, 'forceDelete'])->name('force-delete');
        Route::delete('/restore/{id}', [UserController::class, 'restore'])->name('restore');
        Route::get('/account-setting', [UserController::class, 'AccountSetting'])->name('account-setting');
        Route::get('/change-password', [UserController::class, 'changePw'])->name('change-password');
        Route::put('/change-password/{email}', [UserController::class, 'handleChangePassword'])->name('handle-change-password');
    });
    Route::get('/media', function () {
        return view('admin.media.index');
    })->name('media');
});
Route::prefix('/auth-dashboard')->name('auth.')->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('loginView');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

//Routes dành cho các mẫu
require __DIR__ . '/template.php';
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
