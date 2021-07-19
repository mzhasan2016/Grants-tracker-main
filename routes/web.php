<?php

use App\Http\Controllers\GrantAwardController;
use App\Http\Controllers\GrantReceivingController;
use App\Http\Controllers\GrantController;
use App\Http\Controllers\GrantApplicationController;
use App\Http\Controllers\GrantLiveController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\GrantReportController;
use App\Http\Controllers\GrantSpendingController;
use App\Http\Controllers\MainCategoryController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UploadController;

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

Route::get('/', fn () => redirect()->route('grants.applications'));

Route::get('grants/applications',                   [GrantApplicationController::class, 'index'])->name('grants.applications');
Route::get('grants/live',                           [GrantLiveController::class, 'index'])->name('grants.live');
Route::get('grants/reports',                        [GrantReportController::class, 'index'])->name('grants.reports');

Route::get('grants/{grant}',                        [GrantController::class, 'show'])->name('grants.show');
Route::put('grants/{grant}',                        [GrantController::class, 'update'])->name('grants.update');
Route::put('grants/{grant}/notwon',                 [GrantController::class, 'notwon'])->name('grants.notwon');
Route::put('grants/{grant}/won',                    [GrantController::class, 'won'])->name('grants.won');

Route::post('grants/{grant}/receivings',            [GrantReceivingController::class, 'store'])->name('grants.receivings.store');
Route::delete('grants/categories/{receiving}',      [GrantReceivingController::class, 'destroy'])->name('grants.categories.destroy');

Route::post('grants/{grant}/spendings',             [GrantSpendingController::class, 'store'])->name('grants.spendings.store');

Route::post('grants/{grant}/awards',                [GrantAwardController::class, 'store'])->name('grants.awards.store');

Route::post('categories/maincategory',              [MainCategoryController::class, 'store'])->name('categories.main.store');
Route::post('categories/subcategory',               [SubCategoryController::class, 'store'])->name('categories.sub.store');

Route::get('settings',                              [SettingsController::class, 'index'])->name('settings');

//Zee's code below
Route::get('uploads',                              [UploadController::class, 'index'])->name('uploads.file');

