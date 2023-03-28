<?php

use App\Http\Controllers\backend\CareerController;
use App\Http\Controllers\backend\VacancieController;
use App\Http\Controllers\backend\DepartmentController;
use App\Http\Controllers\backend\GroupReasonTypeController;
use App\Http\Controllers\backend\TypeReasonController;
use App\Http\Controllers\backend\CandidateSourceController;
use App\Http\Controllers\backend\RecruitmentChannelController;
use App\Http\Controllers\backend\RecruitmentRoundController;
use App\Http\Controllers\backend\AddRecruitmentRoundController;
use App\Http\Controllers\backend\ExperienceController;
use App\Http\Controllers\backend\CandidateRequirementController;
use App\Http\Controllers\backend\LevelManagementController;
use App\Http\Controllers\backend\WorkingformController;
use App\Http\Controllers\backend\SetOfInterviewQuestionController;
use App\Http\Controllers\backend\InterviewQuestionController;
use App\Http\Controllers\backend\SampleEmailController;
use App\Http\Controllers\backend\BenefitsEnjoyedController;
use App\Http\Controllers\backend\CandidatepProfileController;
use App\Http\Controllers\backend\TagcandidateController;
use App\Http\Controllers\backend\candidateController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// }); 
// Route::get('/admin', [DasboardController::class, 'index'])->name('admin.index');
// Route::group(['middleware' => 'web'], function () {
    // route Ngành nghề
Route::Resource('career', CareerController::class);
    // route vị trí tuyển dụng
Route::resource('vacancie', VacancieController::class);
    // route phòng ban
Route::resource('department', DepartmentController::class);
    // route nhóm lí do loại
Route::resource('group-reason-type', GroupReasonTypeController::class);
    // route lí do loại
Route::resource('type-reason', TypeReasonController::class);
    // route nguon ung vien  
Route::resource('candidate_source', CandidateSourceController::class);
    // route kenh tuyen dung 
Route::resource('recruitment-Channel', RecruitmentChannelController::class);
    // route loai vong tuyen dung 
Route::resource('type-of-recruitment-round', RecruitmentRoundController::class);
    // route them vong tuyen dung 
Route::resource('add-recruitment-round', AddRecruitmentRoundController::class);
    // route kinh nghiem
Route::resource('experience', ExperienceController::class);
    // route Yêu cầu ứng viên
Route::resource('candidate-requirement', CandidateRequirementController::class);
    // route quản lí cấp bậc
Route::resource('level-management', LevelManagementController::class);
    //route hình thức làm việc
Route::resource('working-form', WorkingformController::class);
    //route bo câu hỏi phỏng vấn
Route::resource('set-of-interview-question', SetOfInterviewQuestionController::class);
    //route câu hỏi phỏng vấn
Route::resource('interview-question', InterviewQuestionController::class);
    //route cemail
Route::resource('sample-email', SampleEmailController::class); 
    //route quyen loi dược hưởng
Route::resource('benefits-enjoyed', BenefitsEnjoyedController::class);
    //route ho so tuyen dung
Route::resource('candidatep-profile', CandidatepProfileController::class);
    //route ho so tuyen dung
Route::resource('tagcandidate', TagcandidateController::class);
// ứng viên
Route::resource('candidate', candidateController::class);
// });
// route người dùng 
// middleware('auth:sanctum') yêu cầu người dùng đăng nhập và xác thực trước khi truy cập vào các hoạt động
Route::middleware('auth:sanctum')->group(function () {
});
Route::resource('user', UserController::class);



//  route login
Route::post('login',[AuthController::class,'login']);
// route token xoa
Route::get('token',[AuthController::class,'getToken'])->middleware('auth:sanctum');
// tao token moi
Route::post('refresh-token',[AuthController::class,'refreshToken']);



     