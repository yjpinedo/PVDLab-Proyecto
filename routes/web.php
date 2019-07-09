<?php

use App\Utils\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::redirect('/', 'home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Home
    Route::get('home', 'AppController@home')->name('home');

    // Admin
    Route::middleware(['role:admin'])->group(function () {

        // Teachers
        Route::resource('teachers', 'TeacherController', ['except' => ['create', 'edit']]);
        // Beneficiaries
        Route::resource('beneficiaries', 'BeneficiaryController', ['except' => ['create', 'edit']]);
        // Courses
        Route::resource('courses', 'CourseController', ['except' => ['create', 'edit']]);
        // Lessons
        Route::resource('lessons', 'LessonController', ['except' => ['create', 'edit']]);
        // Beneficiaries - Courses
        Route::resource('beneficiary_courses', 'BeneficiaryCourseController', ['except' => ['create', 'edit']]);
        // Beneficiaries - Lessons
        Route::resource('beneficiary_lessons', 'BeneficiaryLessonController', ['except' => ['create', 'edit']]);
        // Categories
        Route::resource('categories', 'CategoryController', ['except' => ['create', 'edit']]);
        // Locations
        Route::resource('locations', 'LocationController', ['except' => ['create', 'edit']]);
        // Furniture
        Route::resource('furniture', 'FurnitureController', ['except' => ['create', 'edit']]);
        // Positions
        Route::resource('positions', 'PositionController', ['except' => ['create', 'edit']]);
        // Employees
        Route::resource('employees', 'EmployeeController', ['except' => ['create', 'edit']]);
        // Projects
        Route::resource('projects', 'ProjectController', ['except' => ['create', 'edit']]);
        // Projects - Beneficiaries
        Route::resource('beneficiary_projects', 'BeneficiaryProjectController', ['except' => ['create', 'edit']]);
        Route::resource('transfers', 'TransferController', ['except' => ['create', 'edit']]);
        // Transfers
        Route::resource('furniture_transfers', 'FurnitureTransferController', ['except' => ['create', 'edit']]);
        // Transfer - Furniture

    });

    // Beneficiaries
    Route::middleware(['role:beneficiary'])->namespace('Beneficiary')->prefix('beneficiary')->group(function () {
        // Courses
        Route::resource('courses', 'CourseController', ['except' => ['create', 'destroy', 'edit', 'store']])->names('beneficiary.courses');
        // Projects
        Route::resource('projects', 'ProjectController', ['except' => ['create', 'destroy']])->names('beneficiary.projects');
        // Lessons
        Route::resource('lessons', 'LessonController', ['except' => ['create', 'destroy', 'edit', 'store']])->names('beneficiary.lessons');

    });

    // Teachers
    Route::middleware(['role:teacher'])->namespace('Teacher')->prefix('teacher')->group(function () {
        // Courses
        Route::resource('courses', 'CourseController', ['except' => ['create', 'destroy', 'edit', 'store']])->names('teacher.courses');
        // Lessons
        Route::resource('lessons', 'LessonController', ['except' => ['create']])->names('teacher.lessons');

    });

    // Employees
    Route::middleware(['role:employee'])->namespace('Employee')->prefix('employee')->group(function () {
        // Transfers
        Route::resource('transfers', 'TransferController', ['except' => ['create', 'destroy', 'edit', 'store']])->names('employee.transfers');
        // Beneficiaries
        Route::resource('beneficiaries', 'BeneficiaryController', ['except' => ['create', 'destroy', 'edit', 'store']])->names('employee.beneficiaries');
        // Projects
        Route::resource('projects', 'ProjectController', ['except' => ['create']])->names('employee.projects');
        // Courses
        // Route::resource('courses', 'CourseController', ['except' => ['create', 'destroy', 'edit', 'store']])->names('teacher.courses');

    });

    Route::get('select', 'AppController@select')->middleware('ajax');

});

