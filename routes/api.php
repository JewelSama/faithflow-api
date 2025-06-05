<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParishController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PrayerRequestController;
use App\Http\Controllers\TestimonyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TitheController;
use App\Http\Controllers\OfferingController;
use App\Http\Controllers\DonationController;



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
    Route::get('parishes/prayer-requests/{id}', [ParishController::class, 'prayerRequests']);
    Route::get('parishes/testimonies/{id}', [ParishController::class, 'testimonies']);
    Route::get('parishes/events/{id}', [ParishController::class, 'events']);
    Route::get('parishes/announcements/{id}', [ParishController::class, 'announcements']);
    Route::get('parishes/offerings/{id}', [ParishController::class, 'offerings']);
    Route::get('parishes/tithes/{id}', [ParishController::class, 'tithes']);
    Route::get('parishes/donations/{id}', [ParishController::class, 'donations']);
    Route::get('parishes/finances/{id}', [ParishController::class, 'finances']);
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


    Route::get('prayer-requests', [PrayerRequestController::class, 'index']);
    Route::post('prayer-requests', [PrayerRequestController::class, 'store']);
    Route::get('prayer-requests/{id}', [PrayerRequestController::class, 'show']);
    Route::delete('prayer-requests/{id}', [PrayerRequestController::class, 'destroy']);

    Route::get('testimonies', [TestimonyController::class, 'index']);
    Route::post('testimonies', [TestimonyController::class, 'store']);
    Route::get('testimonies/{id}', [TestimonyController::class, 'show']);
    Route::delete('testimonies/{id}', [TestimonyController::class, 'destroy']);

    Route::get('events', [EventController::class, 'index']);
    Route::post('events', [EventController::class, 'store']);
    Route::get('events/{id}', [EventController::class, 'show']);
    Route::delete('events/{id}', [EventController::class, 'destroy']);

    Route::get('announcements', [AnnouncementController::class, 'index']);
    Route::post('announcements', [AnnouncementController::class, 'store']);
    Route::get('announcements/{id}', [AnnouncementController::class, 'show']);
    Route::put('announcements/{id}', [AnnouncementController::class, 'update']);
    Route::delete('announcements/{id}', [AnnouncementController::class, 'destroy']); 

    Route::prefix('tithes')->group(function () {
        Route::get('/', [TitheController::class, 'index']);
        Route::post('/', [TitheController::class, 'store']);
        Route::get('{id}', [TitheController::class, 'show']);
        Route::delete('{id}', [TitheController::class, 'destroy']);
    });
    
    Route::prefix('offerings')->group(function () {
        Route::get('/', [OfferingController::class, 'index']);
        Route::post('/', [OfferingController::class, 'store']);
        Route::get('{id}', [OfferingController::class, 'show']);
        Route::delete('{id}', [OfferingController::class, 'destroy']);
    });
    
    Route::prefix('donations')->group(function () {
        Route::get('/', [DonationController::class, 'index']);
        Route::post('/', [DonationController::class, 'store']);
        Route::get('{id}', [DonationController::class, 'show']);
        Route::delete('{id}', [DonationController::class, 'destroy']);
    });
});
