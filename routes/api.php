<?php

use App\Http\Controllers\WwjController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WdwController;
use App\Http\Controllers\LywController;

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

//管理员导出Excel表
Route::get('admin/export-company-star', [WwjController::class, 'exportCompanyStar']);
Route::get('admin/export-paper-star', [WwjController::class, 'exportPaperStar']);
Route::get('admin/export-research-star', [WwjController::class, 'exportResearchStar']);
Route::get('admin/export-software-star', [WwjController::class, 'exportSoftwareStar']);
Route::get('admin/export-competition-star', [WwjController::class, 'exportCompetitionStar']);

//管理员查询双创之星
Route::get('admin/company_stars', [WwjController::class, 'ViewCompanyStar']);

//删除双创之星报名接口
Route::delete('student/delete_company_stars', [WwjController::class, 'deleteCompanyStar']);






Route::post('/student/login', [LywController::class, 'LywStudentLogin']);//学生登录
Route::post('/admin/login', [LywController::class, 'LywAdminLogin']);//老师登录
Route::post('/student/register', [LywController::class, 'LywRegistration']);//学生注册
Route::post('/student/sendVerificationCode', [LywController::class, 'sendVerificationCode'])->name('send.verification.code');//验证码
Route::post('student/forgotPassword', [LywController::class, 'forgotPassword']);//忘记密码

Route::middleware('jwt.role:students')->prefix('students')->group(function () {
    Route::post('/logout', [LywController::class, 'logoutStudent']);
});// 学生登出接口

Route::middleware('jwt.role:admins')->prefix('admins')->group(function () {
    Route::post('logout', [LywController::class, 'logoutAdmin']);
});// 管理员登出接口
Route::post('user/forgotPassword', [LywController::class, 'LywUpdatePassword']);//忘记密码

Route::post('admin/password', [LywController::class, 'AdminPassword']);//老师密码加密
