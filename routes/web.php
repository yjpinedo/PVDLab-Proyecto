<?php

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
            'except' => ['create', 'edit'],
            'as' => 'beneficiaries_projects'
        ]);
        Route::put('beneficiaries/{beneficiary}/projects', 'Beneficiaries\ProjectController@updateConcept');

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
        Route::put('projects', 'ProjectController@updateConcept');

        // Transfers
        Route::resource('transfers', 'TransferController', ['except' => ['create', 'edit']]);

        // Member
        Route::resource('members', 'MemberController', ['except' => ['create', 'edit']]);

        // Transfer - Furniture
        Route::resource('furniture_transfers', 'FurnitureTransferController', ['except' => ['create', 'edit']]);

        // responsibility
        //Route::resource('responsibility', 'ResponsibilityController');

        // Format
        Route::resource('formats', 'FormatController', ['only' => ['store', 'show', 'index']]);
        Route::get('/format-responsibility/{beneficiary_id}', 'FormatController@format_responsibility');
        Route::get('/format-authorization/{beneficiary_id}', 'FormatController@format_authorization');

        // Warehouses
        Route::resource('warehouses', 'WarehouseController', ['except' => ['create', 'edit']]);
        Route::resource('warehouses/{warehouse}/article', 'Warehouses\ArticleController', ['except' => ['create', 'edit']]);
        Route::resource('articles', 'ArticleController');
        Route::resource('articles/{article}/warehouse', 'Articles\WarehouseController', ['except' => ['create', 'edit']]);
        Route::resource('movements', 'MovementController', ['except' => ['create', 'edit']]);

        // Loans
        Route::resource('loans', 'LoanController', ['except' => ['create', 'edit']]);
        Route::put('loans', 'LoanController@updateState');
    });

    // Beneficiaries
    Route::middleware(['role:beneficiaries'])->namespace('Beneficiary')->prefix('beneficiary')->group(function () {
        // Courses
        Route::resource('courses', 'CourseController', ['except' => ['create', 'destroy', 'edit', 'store']])->names('beneficiary.courses');

        Route::resource('courses_lists', 'CourseListController', ['except' => ['create', 'destroy', 'edit', 'store']])->names('beneficiary.courses_lists');
        Route::resource('courses_lists/{course}/application_course', 'ApplicationCourseController', ['only' => ['store', 'show', 'index']]);


        Route::name('course_')->group(function () {
            // Lessons
            Route::resource('courses/{course}/lessons', 'LessonController', ['except' => ['create', 'destroy', 'edit']]);
        });

        // Projects
        Route::resource('projects', 'ProjectController', ['except' => ['create', 'destroy']])->names('beneficiary.projects');

        Route::name('project_')->group(function () {
            // Member
            Route::resource('projects/{project}/members', 'MemberController', ['except' => ['create', 'destroy', 'edit']]);
        });

        // Lessons
        Route::resource('lessons', 'LessonController', ['except' => ['create', 'destroy', 'edit', 'store']])->names('beneficiary.lessons');

    });

    // Teachers
    Route::middleware(['role:teachers'])->namespace('Teacher')->prefix('teacher')->group(function () {
        // Courses
        Route::resource('courses', 'CourseController', ['except' => ['create', 'destroy', 'edit']])->names('teacher.courses');

        Route::name('course_')->group(function () {
            // Beneficiaries
            Route::resource('courses/{course}/beneficiaries', 'BeneficiaryController', ['except' => ['create', 'destroy', 'edit', 'store']]);
            // Lessons
            Route::resource('courses/{course}/lessons', 'LessonController', ['except' => ['create', 'destroy', 'edit']]);
            // Lessons - Beneficiaries
            Route::resource('courses/{course}/lessons/{lesson}/take_assistance', 'TakeAssistanceController', ['except' => ['create', 'destroy', 'edit']]);
            //Route::put('projects', 'ProjectController@updateConcept');
            // Lessons - Beneficiaries
            Route::resource('courses/{course}/lessons/{lesson}/assistance', 'AssistanceController', ['except' => ['create', 'destroy', 'edit']]);
        });

    });

    // Employees
    Route::middleware(['role:employees'])->namespace('Employee')->prefix('employee')->group(function () {
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


/*Route::get('foo', function () {
   $pdf = PDF::loadView('welcome');
   return $pdf->stream();
});*/
