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

        // Beneficiaries
        Route::resource('beneficiaries', 'BeneficiaryController', ['except' => ['create', 'edit']]);

        // Beneficiaries - Course
        Route::resource('beneficiaries/{beneficiary}/courses', 'Beneficiaries\CourseController', [
            'except' => ['create', 'destroy', 'edit'],
            'as' => 'beneficiaries_courses'
        ]);

        // Beneficiaries - Projects
        Route::resource('beneficiaries/{beneficiary}/projects', 'Beneficiaries\ProjectController', [
            'except' => ['create', 'destroy', 'edit'],
            'as' => 'beneficiaries_projects'
        ]);

        // Teachers
        Route::resource('teachers', 'TeacherController', ['except' => ['create', 'edit']]);

        // Courses
        Route::resource('courses', 'CourseController', ['except' => ['create', 'edit']]);
        Route::name('course_')->group(function () {
            // Lessons
            Route::resource('courses/{course}/lessons', 'Beneficiaries\LessonController', ['except' => ['create', 'destroy', 'edit']]);
        });

        // Lessons
        Route::resource('lessons', 'LessonController', ['except' => ['create', 'edit']]);

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
        Route::put('projects', 'ProjectController@conceptUpdate');

        // Transfers
        Route::resource('transfers', 'TransferController', ['except' => ['create', 'edit']]);

        // Transfer - Furniture
        Route::resource('furniture_transfers', 'FurnitureTransferController', ['except' => ['create', 'edit']]);

    });

    // Beneficiaries
    Route::middleware(['role:beneficiary'])->namespace('Beneficiary')->prefix('beneficiary')->group(function () {
        // Courses
        Route::resource('courses', 'CourseController', ['except' => ['create', 'destroy', 'edit', 'store']])->names('beneficiary.courses');

        Route::name('course_')->group(function () {
            // Lessons
            Route::resource('courses/{course}/lessons', 'LessonController', ['except' => ['create', 'destroy', 'edit']]);
        });

        // Projects
        Route::resource('projects', 'ProjectController', ['except' => ['create', 'destroy']])->names('beneficiary.projects');
        // Lessons
        Route::resource('lessons', 'LessonController', ['except' => ['create', 'destroy', 'edit', 'store']])->names('beneficiary.lessons');

    });

    // Teachers
    Route::middleware(['role:teacher'])->namespace('Teacher')->prefix('teacher')->group(function () {
        // Courses
        Route::resource('courses', 'CourseController', ['except' => ['create', 'destroy', 'edit', 'store']])->names('teacher.courses');

        Route::name('course_')->group(function () {
            // Lessons
            Route::resource('courses/{course}/lessons', 'LessonController', ['except' => ['create', 'destroy', 'edit']]);
        });

        // Lessons
        // Route::resource('lessons', 'LessonController', ['except' => ['create']])->names('teacher.lessons');

    });

    // Employees
    Route::middleware(['role:employee'])->namespace('Employee')->prefix('employee')->group(function () {
        // Transfers
        Route::resource('transfers', 'TransferController', ['except' => ['create', 'destroy', 'edit', 'store']])->names('employee.transfers');
        // Beneficiaries
        Route::resource('beneficiaries', 'BeneficiaryController', ['except' => ['create', 'destroy', 'edit', 'store']])->names('employee.beneficiaries');
        // Projects
        Route::resource('projects', 'ProjectController', ['except' => ['create']])->names('employee.projects');
        Route::put('projects', 'ProjectController@conceptUpdate');
        // Courses
        // Route::resource('courses', 'CourseController', ['except' => ['create', 'destroy', 'edit', 'store']])->names('teacher.courses');

    });

    Route::get('select', 'AppController@select')->middleware('ajax');

});

