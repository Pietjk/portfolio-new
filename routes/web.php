<?php

use App\Http\Controllers\AboutTextController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Models\AboutText;
use App\Models\Project;
use Illuminate\Support\Facades\Route;

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
    $allProjects = Project::all();
    $projects = $allProjects->where('is_small', '=', false);
    $projects_sm = $allProjects->where('is_small', '=', true);

    $about = AboutText::all();
    $aboutHeader = $about->whereNotNull('image_path')->first();
    $aboutParagraphs = $about->whereNull('image_path');

    return view('home', compact('projects', 'projects_sm', 'aboutHeader', 'aboutParagraphs'));
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('project', ProjectController::class)->except('index', 'show');
    Route::resource('aboutText', AboutTextController::class)->except('index', 'show');
});

require __DIR__.'/auth.php';
