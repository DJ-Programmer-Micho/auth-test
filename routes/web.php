<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Other\FactController;
use App\Http\Controllers\About\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Setting\EnvController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Other\ServicesController;
use App\Http\Controllers\Other\WhyChooseUsController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    // $batchFilePath = base_path('terminator.bat');
    // chdir(dirname($batchFilePath));
    // $command = 'start /B /WAIT cmd /C "'.$batchFilePath.'"';
    // exec($command, $output, $returnCode);
    return view('admin.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/logout','destroy')->name('admin.logout');
    Route::get('/admin/profile','Profile')->name('admin.profile');
    Route::get('/admin/profile/edit','EditProfile')->name('edit.profile');
    Route::post('/admin/profile/store','StoreProfile')->name('store.profile');
    Route::get('/admin/profile/passedit','EditPassword')->name('edit.password');
    Route::post('/admin/profile/passupdate','StorePassword')->name('edit.save.password');
});

// Route::controller(EnvController::class)->group(function(){
//     Route::get('/setting/smtp','index')->name('setting.smtp');
//     Route::post('/setting/smtp','store')->name('update.smtp');
// });

Route::prefix('setting')->middleware('auth')->group(function () {
    Route::get('/smtp', [EnvController::class, 'index'])->name('setting.smtp');
    Route::post('/smtp', [EnvController::class, 'store'])->name('update.smtp');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::controller(PageController::class)->group(function(){
    Route::get('/admin/page/','index')->name('page.index');
    Route::get('/admin/page/edit','edit')->name('page.edit');
    Route::get('/admin/page/create','create')->name('page.create');
    Route::post('/admin/page/edit','store')->name('update.properties');
});

require __DIR__.'/auth.php';



/*
|--------------------------------------------------------------------------
| Setup Route
|--
*/
// Route::controller(SetupController::class)->group(function(){
//     Route::get('/metiraq/setup-4652-9857-7895-2321','index')->name('setup.met.start');
//     Route::get('/metiraq/setup-4652-9857-7895-2322','final')->name('setup.met.last');
//     Route::post('/metiraq/setup-4652-9857-7895-2323','createDB')->name('setup.createdb');
//     Route::post('/metiraq/setup-4652-9857-7895-2324','createUser')->name('setup.createuser');
// });

/*
|--------------------------------------------------------------------------
| Main Page Route (USER)
|--
*/
Route::get('/', function () {
    return view('main.pages.indexHome');
});
Route::get('/about', function () {
    return view('main.pages.indexAbout');
});
Route::get('/services', function () {
    return view('main.pages.indexService');
});

Route::controller(HomeSliderController::class)->group(function(){
    Route::get('/admin/homeslider','index')->name('home.index'); //ADMIN SIDE PAGE
    Route::get('/admin/homeslider/create','create')->name('home.create'); //ADMIN SIDE PAGE
    Route::post('/admin/homeslider/create','store')->name('home.store'); //ADMIN SIDE PAGE
});

Route::controller(FactController::class)->group(function(){
    Route::get('/admin/fact','index')->name('fact.index'); 
    Route::get('/admin/fact/create','create')->name('fact.create'); 
    Route::post('/admin/fact/create','store')->name('fact.store'); 
});

Route::controller(AboutController::class)->group(function(){
    Route::get('/admin/about','index')->name('about.index'); //ADMIN SIDE PAGE
    Route::get('/admin/about/create','create')->name('about.create'); //ADMIN SIDE PAGE
    Route::post('/admin/about/create','store')->name('about.store'); //ADMIN SIDE PAGE
});

Route::controller(WhyChooseUsController::class)->group(function(){
    Route::get('/admin/wcu','index')->name('wcu.index'); //ADMIN SIDE PAGE
    Route::get('/admin/wcu/create','create')->name('wcu.create'); //ADMIN SIDE PAGE
    Route::post('/admin/wcu/create','store')->name('wcu.store'); //ADMIN SIDE PAGE
});

Route::controller(ServicesController::class)->group(function(){
    Route::get('/admin/service','index')->name('service.index'); //ADMIN SIDE PAGE
    Route::get('/admin/service/create','create')->name('service.create'); //ADMIN SIDE PAGE
    Route::post('/admin/service/store','store')->name('service.store'); //ADMIN SIDE PAGE
    Route::get('/admin/service/edit/{id}','edit')->name('service.edit'); //ADMIN SIDE PAGE
    Route::get('/admin/service/delete/{id}','delete')->name('service.delete'); //ADMIN SIDE PAGE
    Route::post('/admin/service/update/','update')->name('service.update'); //ADMIN SIDE PAGE
    Route::get('/admin/service/info','info')->name('service.info'); //ADMIN SIDE PAGE
    Route::get('/admin/service/preview','preview')->name('service.preview'); //ADMIN SIDE PAGE
    Route::post('/admin/service/info','add')->name('service.info.store'); //ADMIN SIDE PAGE
    // User Side
    Route::get('/service/details/{id}','serviceDetails')->name('service.details'); //ADMIN SIDE PAGE
}); 