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

Route::controller(AboutController::class)->group(function(){
    Route::get('/admin/about/create','create')->name('about.create');
    Route::post('/admin/about/create','store')->name('about.store');
});

Route::controller(PageController::class)->group(function(){
    Route::get('/admin/page/','index')->name('about.index');
    Route::get('/admin/page/edit','edit')->name('about.edit');
    Route::get('/admin/page/create','create')->name('about.create');
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

Route::controller(HomeSliderController::class)->group(function(){
    Route::get('/home','HomeSlider')->name('home.slider');
    Route::get('/admin/home','index')->name('home.index');
    Route::get('/admin/create','create')->name('home.create');
    Route::post('/admin/create','store')->name('home.store');
});


Route::controller(FactController::class)->group(function(){
    Route::get('/admin/fact/create','create')->name('fact.create');
    Route::post('/admin/fact/create','store')->name('fact.store');
});