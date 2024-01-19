<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TipiController;
use App\Http\Controllers\UserController;
use App\Models\Page;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [RegisteredUserController::class, 'store'])
  ->middleware('guest')
  ->name('register');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
  ->middleware('guest')
  ->name('login');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
  ->middleware('guest')
  ->name('password.email');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
  ->middleware('guest')
  ->name('password.store');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
  ->middleware(['auth', 'signed', 'throttle:6,1'])
  ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
  ->middleware(['auth', 'throttle:6,1'])
  ->name('verification.send');

// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth');


Route::get('/blog', [PostController::class, 'blog']);
Route::get('/archiveFilter', [PostController::class, 'archiveFilterd']);
Route::get('/categoryfilter/{category}', [CategoryController::class, 'categoryfilter']);
Route::get('/home', [HomeController::class, 'index']);

Route::group(['test' => 'test'], function () {
  Route::get('/getQuestion', [TestController::class, 'doTheTest']);
  // Route::get('/result', 'Auth\RegisterController@notvalide');
  Route::post('/result', [TestController::class, 'introExtroQuestions']);
  // Route::get('/result', [TestController::class, 'introExtroQuestionsResult']);
});


Route::post('/search', [PostController::class, 'search']);
Route::post('/admin', [AdminController::class, 'questionResult']);

Route::get('faqe/{slug}', function ($slug) {
  try {
    $page =  Page::where('slug', $slug)->first();
    return view('pages.page')
      ->with('content', $page->content)
      ->with('title', $page->title);

    // $page = Page::slug();

  } catch (Exception $e) {
    return abort(404);
  }
});

Route::group(['tipet' => 'tipet'], function () {
  Route::get('/personalityTypes', [TipiController::class, 'index']);
  Route::get('/type/{id}', [TipiController::class, 'show']);
});



Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
  return $request->user();
});

Route::middleware(['auth:sanctum', 'admin'])->get('/admin', [AdminController::class, 'index']);

//Posts
Route::middleware(['auth:sanctum', 'admin'])->get('/post', [PostController::class, 'index']);
Route::middleware(['auth:sanctum', 'admin'])->get('/post/create', [PostController::class, 'create']);
Route::middleware(['auth:sanctum'])->get('/blog/{id}', 'PostController@show');
// Route::middleware(['auth:sanctum', 'admin'])->get('/post/edit/{id}', [PostController::class, 'edit']);
Route::middleware(['auth:sanctum', 'admin'])->post('/post/store', [PostController::class, 'store']);
Route::middleware(['auth:sanctum', 'admin'])->post('/post/{id}/update', [PostController::class, 'update']);
Route::middleware(['auth:sanctum', 'admin'])->post('/post/{id}/delete', [PostController::class, 'destroy']);
//Questions
Route::middleware(['auth:sanctum'])->get('/pyetjet', [QuestionController::class, 'index']);
Route::middleware(['auth:sanctum', 'admin'])->get('/pyetjet/create', [QuestionController::class, 'create']);
Route::middleware(['auth:sanctum', 'admin'])->post('/pyetjet/store', [QuestionController::class, 'store']);
Route::middleware(['auth:sanctum', 'admin'])->get('/pyetjet/{id}', [QuestionController::class, 'show']);
// Route::middleware(['auth:sanctum', 'admin'])->get('/pyetjet/{id}/edit', [QuestionController::class, 'edit']);
Route::middleware(['auth:sanctum', 'admin'])->post('/pyetjet/{id}/edit', [QuestionController::class, 'update']);
Route::middleware(['auth:sanctum', 'admin'])->post('/pyetjet/{id}/delete', [QuestionController::class, 'destroy']);
//Tipi
Route::middleware(['auth:sanctum', 'admin'])->get('/admintipet', [TipiController::class, 'showTypes']);
Route::middleware(['auth:sanctum', 'admin'])->get('/admintipet/{id}', [TipiController::class, 'edit']);
Route::middleware(['auth:sanctum', 'admin'])->post('/admintipet/{id}/update', [TipiController::class, 'update']);
//pages
Route::middleware(['auth:sanctum', 'admin'])->get('/faqet', [PageController::class, 'index']);
Route::middleware(['auth:sanctum', 'admin'])->get('/faqet/create', [PageController::class, 'create']);
Route::middleware(['auth:sanctum', 'admin'])->post('/faqet/store', [PageController::class, 'store']);
Route::middleware(['auth:sanctum', 'admin'])->get('/faqet/{id}', [PageController::class, 'show']);
// Route::middleware(['auth:sanctum', 'admin'])->get('/faqet/{id}/edit', [PageController::class, 'edit']);
Route::middleware(['auth:sanctum', 'admin'])->post('/faqet/{id}/update', [PageController::class, 'update']);
Route::middleware(['auth:sanctum', 'admin'])->post('/faqet/{id}/delete', [PageController::class, 'destroy']);

//Comments
Route::middleware(['auth:sanctum', 'admin'])->get('/comments', [CommentController::class, 'index']);
Route::middleware(['auth:sanctum', 'admin'])->get('/comments/create', [CommentController::class, 'create']);
Route::middleware(['auth:sanctum', 'admin'])->post('/post/{post}/comment', 'CommentController@store')
  ;
Route::middleware(['auth:sanctum', 'admin'])->get('/comments/{id}', [CommentController::class, 'show']);
// Route::middleware(['auth:sanctum', 'admin'])->get('/comments/{id}/edit', [CommentController::class, 'edit']);
Route::middleware(['auth:sanctum', 'admin'])->post('/comments/{id}/update', [CommentController::class, 'update']);
Route::middleware(['auth:sanctum', 'admin'])->post('/comments/delete/{id}', [CommentController::class, 'destroy']);

//Category
Route::middleware(['auth:sanctum', 'admin'])->get('/categories', [CategoryController::class, 'index']);
Route::middleware(['auth:sanctum', 'admin'])->get('/categories/create', [CategoryController::class, 'create']);
Route::middleware(['auth:sanctum', 'admin'])->get('/categories/{id}', 'CategoryController@show');
// Route::middleware(['auth:sanctum', 'admin'])->get('/categories/{id}/edit', [CategoryController::class, 'edit']);
Route::middleware(['auth:sanctum', 'admin'])->post('/categories/store', [CategoryController::class, 'store']);
Route::middleware(['auth:sanctum', 'admin'])->post('/categories/{id}/update', [CategoryController::class, 'update']);
Route::middleware(['auth:sanctum', 'admin'])->post('/categories/delete/{id}', [CategoryController::class, 'destroy']);

//profile
Route::middleware(['auth:sanctum'])->get('/profile', [UserController::class, 'index']);
Route::middleware(['auth:sanctum'])->get('/profili/{id}/edit', [UserController::class, 'edit']);
Route::middleware(['auth:sanctum'])->post('/profili/{id}/update', [UserController::class, 'update']);

//Gallery
// Route::middleware(['auth:sanctum', 'admin'])->get('/galeria', [GalleryController::class, 'index']);
// Route::middleware(['auth:sanctum', 'admin'])->post('/galeria/store', [GalleryController::class, 'store']);
// Route::middleware(['auth:sanctum', 'admin'])->get('/galleria/{id}', [GalleryController::class, 'show']);
// Route::middleware(['auth:sanctum', 'admin'])->post('/galleria/delete/{id}', [GalleryController::class, 'destroy']);
