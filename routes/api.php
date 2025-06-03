<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParishController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;



Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return response()->json([
        'status' => 'success',
        'profile' => $request->user()
    ], 200);
});


Route::post('/login', [AuthController::class, 'login'])->name('login');



Route::middleware('auth:sanctum')->group(function () {
    Route::get('validate-token', [AuthController::class, 'validateToken'])->name('validate.token');

    Route::get('parishes', [ParishController::class, 'index']);
    Route::post('parishes', [ParishController::class, 'store']);
    Route::get('parishes/members/{id}', [ParishController::class, 'members']);
    Route::get('parishes/departments/{id}', [ParishController::class, 'departments']);
    Route::get('parishes/{id}', [ParishController::class, 'show']);
    Route::put('parishes/{id}', [ParishController::class, 'update']);
    Route::delete('parishes/{id}', [ParishController::class, 'destroy']);


    Route::get('users', [UserController::class, 'index']);
    Route::post('users', [UserController::class, 'store']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);

    Route::get('members', [MemberController::class, 'index']);
    Route::post('members', [MemberController::class, 'store']);
    Route::get('members/{id}', [MemberController::class, 'show']);
    Route::put('members/{id}', [MemberController::class, 'update']);
    Route::delete('members/{id}', [MemberController::class, 'destroy']);
    Route::put('members/{id}/assign-department', [MemberController::class, 'assignDepartment']);



    Route::get('departments', [DepartmentController::class, 'index']);
    Route::post('departments', [DepartmentController::class, 'store']);
    Route::get('departments/{id}', [DepartmentController::class, 'show']);
    Route::put('departments/{id}', [DepartmentController::class, 'update']);
    Route::delete('departments/{id}', [DepartmentController::class, 'destroy']);
});
