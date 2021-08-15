<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PortfolioController;

use App\Models\Review;
use App\Models\User;
use App\Models\Purposal;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\PurposalController;
// use App\Http\Controllers\Api\VerificationController;
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

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

//email vertification
// Route::middleware('auth:sanctum','verified')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');

Route::post('forget-password', [NewPasswordController::class, 'forgetPassword']);
Route::post('reset-password', [NewPasswordController::class, 'reset']);


//email vertification
// Auth::routes(['verify'=>true]);
// Route::get('/email/resend', [VerificationController::class,'resend'])->name('verification.resend')->middleware('auth:sanctum');
// Route::get('/email/verify/{id}/{hash}',[VerificationController::class,'verify'])->name('verification.verify')->middleware('auth:sanctum');

// Route::get('/email/resend', 'Api\VerificationController@resend')->name('verification.resend');
// Route::get('/email/verify/{id}/{hash}', 'Api\VerificationController@verify')->name('verification.verify');


Route::group(['middleware' => ['auth:sanctum'] ], function() {
    /*routes need to access */
    // Route::post('/users',[UserController::class,'store']);
    // Route::post('/project',[projectController::class,'store']);
    // Route::get('/users',[UserController::class,'index']);
    // Route::get('/users/{id}',[UserController::class,'show']);
    Route::post('/logout',[AuthController::class,'logout']);

});

//purposal
Route::get('/purposal',[PurposalController::class,'index']);
Route::get('/purposal/{id}',[PurposalController::class,'getPurposal']);
Route::post('/purposal',[PurposalController::class,'store']);
// Route::put('/purposal/{id}',[PurposalController::class,'update']);
// Route::delete('/purposal/{id}',[PurposalController::class,'destroy']);

//========================================================================//


//mohamed Start users routes
Route::get('/users',[UserController::class,'index']);
Route::get('/users/{id}',[UserController::class,'show']);
Route::post('/users',[UserController::class,'store']);
Route::put('/users/{id}',[UserController::class,'update']);
Route::delete('/users/{id}',[UserController::class,'destroy']);
Route::post('upload/{id}',[UploadController::class,'upload']);
//mohamed End users routes
Route::get('/developers',[UserController::class,'getDevelopers']);
Route::get('/mostProjects',[ProjectController::class,'getMostProjects']);

Route::get('/reviews',[ReviewController::class,'index']);
Route::get('/HomeReviews',[ReviewController::class,'HomeReviews']);
Route::post('/reviews',[ReviewController::class,'store']);
Route::get('/review/{id}',[ReviewController::class,'show']);


//***********************( islam )***********************//
Route::get('/portfolio',[PortfolioController::class,'index']);
Route::get('/portfolio/{id}',[PortfolioController::class,'show']);
Route::post('/portfolio/{id}',[PortfolioController::class,'store']);
Route::put('/portfolio/{id}',[PortfolioController::class,'update']);
Route::delete('/portfolio/{id}',[PortfolioController::class,'destroy']);
Route::get('/portfolio/count/{id}',[PortfolioController::class,'count']);
Route::get('/project/count/{id}/{status}',[ProjectController::class,'count']);
Route::get('/project/active/{id}',[ProjectController::class,'active']);
Route::get('/project/recent/{categry_id}',[ProjectController::class,'recent']);
// Route::post('/portfolio/upload/{id}',[PortfolioController::class,'upload']);
// Route::apiResource('portfolio',App\Http\Controllers\PortfolioController::class);


//catagories

Route::get('/categories',[CategoryController::class,'index']);
Route::get('/categories/{categoryname}',[CategoryController::class,'show']);
//project
Route::get('/project',[ProjectController::class,'index']);
//Route::get('/project/{id}',[ProjectController::class,'show']);
Route::get('/project/{id}',[ProjectController::class,'gettProject']);
 Route::post('/project',[ProjectController::class,'store']);
Route::put('/project/{id}',[ProjectController::class,'update']);
Route::delete('/project/{id}',[ProjectController::class,'destroy']);



//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
