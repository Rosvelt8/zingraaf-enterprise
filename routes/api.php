<?php

use App\Http\Controllers\Api\DivisionController;
use App\Http\Controllers\Api\EnterpriseController;
use App\Http\Controllers\Api\hoursSuppController;
use App\Http\Controllers\Api\profileController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TaskReportController;
use App\Http\Controllers\Api\TrackingController;
use App\Http\Controllers\Api\UserController;
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
// Authentications routes
Route::prefix('user')->group(function(){
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
});


Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/updatePassword', [profileController::class, 'updatePassword']);
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/getAuthUser', [profileController::class, 'getProfile']);
    Route::get('/getuser', [profileController::class, 'showUser']);
    Route::get('/getusers', [profileController::class, 'showAllUsers']);


    Route::prefix('enterprise')->group(function(){
        Route::post('/new', [EnterpriseController::class, 'createEnterprise']);
        Route::put('/update', [EnterpriseController::class, 'updateEnterprise']);
        Route::get('/getOne', [EnterpriseController::class, 'getEnterprise']);
        Route::get('/getAll', [EnterpriseController::class, 'getAllEnterprises']);
        Route::delete('/delete', [EnterpriseController::class, 'deleteEnterprise']);
    });
    
    
    
    Route::prefix('division')->group(function(){
        Route::post('/new', [DivisionController::class, 'createDivision']);
        Route::put('/update', [DivisionController::class, 'updateDivision']);
        Route::get('/getOne', [DivisionController::class, 'getDivision']);
        Route::get('/getAll', [DivisionController::class, 'getAllDivisions']);
        Route::delete('/delete', [DivisionController::class, 'deleteDivision']);
        
    });

    Route::prefix('hoursSupp')->group(function(){
        Route::post('/new', [hoursSuppController::class, 'addHoursSupp']);
        Route::get('/getAll', [hoursSuppController::class, 'getHourSuppByEmployee']);
        
    });

    Route::prefix('hours')->group(function(){
        Route::post('/track', [TrackingController::class, 'employeeTracking']);
        
    });
    
    Route::prefix('task')->group(function(){
        Route::post('/new', [TaskController::class, 'createTask']);
        Route::put('/update', [TaskController::class, 'updateTask']);
        Route::get('/getOne', [TaskController::class, 'getTask']);
        Route::get('/getAll', [TaskController::class, 'getAllTasks']);
        Route::get('/listAssigned', [TaskController::class, 'getAllTasksAssigned']);
        Route::get('/listAssignedByTask', [TaskController::class, 'getAllTasksAssignedByTask']);
        Route::post('/assign', [TaskController::class, 'assignTask']);
        Route::put('/updateAssignStatus', [TaskController::class, 'updateAssignStatus']);
        Route::delete('/delete', [TaskController::class, 'deleteTask']);
    });

    Route::prefix('taskReport')->group(function(){
        Route::post('/createTaskReport', [TaskReportController::class, 'createTaskReport']);
        Route::post('/reportPhoto', [TaskReportController::class, 'createPhotoReport']);
        Route::get('/getTaskReport', [TaskReportController::class, 'getTaskReport']);
        Route::get('/getTasksReportForManagers', [TaskReportController::class, 'getAllTasksReports']);
        Route::get('/getTasksReportForEmployees', [TaskReportController::class, 'getAllTasksReports']);
        
    });
});


