<?php

use App\Http\Controllers\Admin\AdminCommentsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\VideoGameController;
use App\Http\Controllers\Admin\AdminUsersController;
use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminGamesController;

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

Route::get('/', [\App\Http\Controllers\PagesController::class, 'home'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/admin/video-games', [AdminGamesController::class, 'indexAdmin'])->name('admin.video_games.index');
    Route::get('/admin/comments', [AdminCommentsController::class, 'index'])->name('admin.comments.index');
    Route::delete('/video-games/{id}', [AdminGamesController::class, 'deleteVideoGame'])->name('deleteVideoGame');
    Route::get('/admin/video-games/create', [AdminGamesController::class, 'create'])->name('admin.video_games.create');
    Route::post('/video-games', [AdminGamesController::class, 'store'])->name('admin.video_games.store');
    Route::get('/admin/video-games/{id}/edit', [AdminGamesController::class, 'edit'])->name('admin.video_games.edit');
    Route::put('/video_games/{id}', [AdminGamesController::class, 'update'])->name('admin.video_games.update');
    Route::get('/admin/users', [AdminUsersController::class, 'index'])->name('admin.users.index');
    Route::delete('/admin/users/{user}', [AdminUsersController::class, 'destroy'])->name('admin.users.destroy');
    Route::put('/admin/users/{user}/update-role', [AdminUsersController::class, 'updateRole'])->name('admin.users.updateRole');



});
Route::post('/suggestions', [SuggestionController::class, 'sendSuggestion'])->name('suggestions.sendSuggestion');
Route::get('/suggestions', [SuggestionController::class, 'suggest'])->name('suggestions.suggest');

Route::get('/videogames', [VideoGameController::class, 'showList'])->name('video_games.list');

Route::get('/video_games/{id}', [VideoGameController::class, 'show'])->name('video_games.show');
Route::get('/videogames/search', [VideoGameController::class, 'search'])->name('video_games.search');

Route::delete('/favorites/{id}', [FavoriteController::class, 'remove'])->name('favorites.remove');

Route::post('/toggle-favorite', [FavoriteController::class, 'toggleFavorite'])->name('toggle.favorite');


Route::delete('/profile/{id}', [FavoriteController::class, 'remove'])->name('favorites.remove');
Route::get('/profile/{id}', [CommentController::class, 'show'])->name('profile.show');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::delete('/comments/{id}', [CommentController::class, 'delete'])->name('comments.delete');



require __DIR__.'/auth.php';
