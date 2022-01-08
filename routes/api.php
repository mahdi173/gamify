<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/questions/getQsts', [QuestionController::class, 'getQsts']);

Route::post('/questions/postAns', [QuestionController::class, 'Ans']);

Route::get('/questions/getQstNv2', [QuestionController::class, 'getQstNv2']);

Route::post('/questions/ans1Nv2', [QuestionController::class, 'ans1Nv2']);
Route::post('/questions/getQstsNv0', [QuestionController::class, 'getQstsNv0']);
Route::post('/questions/AnsNv0', [QuestionController::class, 'AnsNv0']);

Route::post('/questions/AnsMulti1', [QuestionController::class, 'AnsMulti1']);

Route::post('/questions/AnsAc1Nv3', [QuestionController::class, 'AnsAc1Nv3']);

Route::post('/questions/AnsAc2Nv3', [QuestionController::class, 'AnsAc2Nv3']);

Route::get('/questions/randomBonus', [QuestionController::class, 'randomBonus']);

Route::post('/questions/getUserXp', [QuestionController::class, 'getUserXp']);

Route::post('/home/getTopUsers', [HomeController::class, 'getTopUsers']);
