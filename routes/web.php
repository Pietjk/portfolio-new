<?php

use App\Http\Controllers\AboutTextController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectDetailController;
use App\Http\Controllers\SkillController;
use App\Models\AboutText;
use App\Models\Category;
use App\Models\Employer;
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
    $allProjects = Project::withCount('projectDetails')->with(['skills', 'employer'])->recentFirst()->get();
    $projects = $allProjects->where('is_small', '=', false);
    $projects_sm = $allProjects->where('is_small', '=', true);

    $about = AboutText::all();
    $aboutHeader = $about->whereNotNull('image_path')->first();
    $aboutParagraphs = $about->whereNull('image_path');

    $categories = Category::with('skills')->get();

    $employers = Employer::has('experiences')
        ->with(['experiences' => fn ($query) => $query->orderByDesc('start_date'), 'experiences.skills'])
        ->withMax('experiences', 'start_date')
        ->orderByDesc('experiences_max_start_date')
        ->get();

    return view('home', compact('projects', 'projects_sm', 'aboutHeader', 'aboutParagraphs', 'categories', 'employers'));
})->name('home');

Route::get('/projects/{project:slug}', [ProjectDetailController::class, 'show'])->name('project_details.show');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::delete('aboutText/{aboutText}/image', [AboutTextController::class, 'destroyImage'])->name('aboutText.image.destroy');
    Route::delete('projectDetail/{projectDetail}/image', [ProjectDetailController::class, 'destroyImage'])->name('projectDetail.image.destroy');
    Route::delete('category/{category}/image', [CategoryController::class, 'destroyImage'])->name('category.image.destroy');
    Route::delete('skill/{skill}/image', [SkillController::class, 'destroyImage'])->name('skill.image.destroy');

    Route::resource('project', ProjectController::class)->except('index', 'show');
    Route::resource('aboutText', AboutTextController::class)->except('index', 'show');
    Route::resource('projectDetail', ProjectDetailController::class)->except('index', 'show');
    Route::resource('category', CategoryController::class)->except('index', 'show');
    Route::resource('skill', SkillController::class)->except('index', 'show');
    Route::resource('employer', EmployerController::class)->except('index', 'show');
    Route::resource('experience', ExperienceController::class)->except('index', 'show');
});

require __DIR__.'/auth.php';
