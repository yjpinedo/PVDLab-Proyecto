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
        // Positions
        Route::resource('positions', 'PositionController', ['except' => ['create', 'edit']]);
        // Employees
        Route::resource('employees', 'EmployeeController', ['except' => ['create', 'edit']]);

        // Projects
        Route::resource('projects', 'ProjectController', ['except' => ['create', 'edit']]);
        Route::put('projects', 'ProjectController@updateConcept');

        // Member
        Route::resource('members', 'MemberController', ['except' => ['create', 'edit']]);

        // Format
        Route::resource('formats', 'FormatController', ['only' => ['store', 'show', 'index']]);
        Route::get('/format-loan/{beneficiary_id}/{loan_id}/loan', 'FormatController@format_loans');
        Route::get('/format-project/{project_id}/project', 'FormatController@format_project');
        Route::get('/format-responsibility/{beneficiary_id}', 'FormatController@format_responsibility');
        Route::get('/format-authorization/{beneficiary_id}', 'FormatController@format_authorization');
        Route::get('/format-loans-beneficiaries', 'FormatController@getLoansByBeneficiary')->name('formats.format-loans-beneficiaries');

        // Warehouses
        Route::resource('warehouses', 'WarehouseController', ['except' => ['create', 'edit']]);
        Route::resource('warehouses/{warehouse}/article', 'Warehouses\ArticleController', ['except' => ['create', 'edit']]);
        // Articles
        Route::resource('articles', 'ArticleController');
        Route::resource('articles/{article}/warehouse', 'Articles\WarehouseController', ['except' => ['create', 'edit']]);
        // Movements
        Route::resource('movements', 'MovementController', ['except' => ['create', 'edit']]);

        // Loans
        Route::resource('loans', 'LoanController')->except('show');
        Route::resource('loans/{loan}/article', 'Loans\ArticleController', ['except' => ['create', 'edit']]);
        Route::put('loans', 'LoanController@updateState');
        Route::get('loans/get_articles_by_id', 'LoanController@getArticleById')->name('loans.get_articles_by_id');

        // Users
        Route::resource('users', 'UserController', ['except' => ['create', 'edit', 'show', 'update', 'destroy']])->names('users');
        Route::get('users/get-roles', 'UserController@getRoles')->name('users.getRoles');

        // Update Password
        /*Route::resource('update-password', 'UpdatePasswordController', ['except' => ['create', 'edit','update', 'destroy']])->names('update-password');

        // Profile
        Route::resource('profile', 'ProfileController', ['except' => ['create', 'edit','update', 'destroy']])->names('profile');*/

        // Dashboard
        //Route::resource('dashboard', 'DashboardController', ['except' => ['create', 'edit','update', 'destroy', 'store', 'show']])->names('dashboards.users');
        Route::prefix('dashboards')->group(function (){
            Route::resource('courses', 'Dashboard\CourseController', ['except' => ['create', 'edit','update', 'destroy', 'store', 'show']])->names('dashboards.courses');
            Route::resource('projects', 'Dashboard\ProjectController', ['except' => ['create', 'edit','update', 'destroy', 'store', 'show']])->names('dashboards.projects');
            Route::resource('users', 'Dashboard\UserController', ['except' => ['create', 'edit','update', 'destroy', 'store', 'show']])->names('dashboards.users');
        });
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

        // Loans
        Route::resource('loans', 'LoanController', ['except' => ['show']])->names('beneficiary.loans');
        Route::resource('loans/{loan}/article', 'LoanArticleController')->names('beneficiary.loans.article');
        Route::get('loans/get_articles_by_id', 'LoanController@getArticleById')->name('beneficiary.loans.get_articles_by_id');

        // Update Password
        Route::resource('update-password', 'UpdatePasswordController', ['except' => ['create', 'edit','update', 'destroy']])->names('beneficiary.update-password');

        // Profile
        Route::resource('profile', 'ProfileController', ['except' => ['create', 'edit','update', 'destroy']])->names('beneficiary.profile');

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
        });
        // Update Password
        Route::resource('update-password', 'UpdatePasswordController', ['except' => ['create', 'edit','update', 'destroy']])->names('teacher.update-password');

        // Profile
        Route::resource('profile', 'ProfileController', ['except' => ['create', 'edit','update', 'destroy']])->names('teacher.profile');
    });

    // Employees
    Route::middleware(['role:employees'])->namespace('Employee')->prefix('employee')->group(function () {

        // Articles
        Route::resource('articles', 'ArticleController')->names('employee.articles');
        Route::resource('articles/{article}/warehouse', 'Articles\WarehouseController', ['except' => ['create', 'edit']])->names('employee.articles.warehouses');

        // Beneficiaries
        Route::resource('beneficiaries', 'BeneficiaryController', ['except' => ['create', 'destroy', 'edit']])->names('employee.beneficiaries');
        Route::resource('beneficiaries/{beneficiary}/courses', 'Beneficiaries\CourseController', ['only' => ['index']])->names('employee.beneficiaries.courses');
        Route::resource('beneficiaries/{beneficiary}/projects', 'Beneficiaries\ProjectController', ['except' => ['create', 'destroy', 'edit']])->names('employee.beneficiaries.projects');
        Route::put('beneficiaries/{beneficiary}/projects', 'Beneficiaries\ProjectController@updateConcept')->name('employee.beneficiaries.projects.update');

        // Courses
        Route::resource('courses', 'CourseController', ['except' => ['create', 'edit']])->names('employee.courses');
        Route::name('course_')->group(function () {
            // Lessons
            Route::resource('courses/{course}/lessons', 'Beneficiaries\LessonController', ['except' => ['create', 'destroy', 'edit']])->names('employee.courses.lessons');
        });

        // Formats
        Route::resource('formats', 'FormatController', ['only' => ['store', 'show', 'index']])->names('employee.formats');
        Route::get('/format-loan/{beneficiary_id}/{loan_id}/loan', 'FormatController@format_loans')->name('employee.formats.loans');
        Route::get('/format-project/{project_id}/project', 'FormatController@format_project')->name('employee.formats.project');
        Route::get('/format-responsibility/{beneficiary_id}', 'FormatController@format_responsibility')->name('employee.formats.responsibility');
        Route::get('/format-authorization/{beneficiary_id}', 'FormatController@format_authorization')->name('employee.formats.authorization');
        Route::get('/format-loans-beneficiaries', 'FormatController@getLoansByBeneficiary')->name('employee.formats.format-loans-beneficiaries');

        // loans
        Route::resource('loans', 'LoanController')->except('show')->names('employee.loans');
        Route::resource('loans/{loan}/article', 'Loans\ArticleController', ['except' => ['create', 'edit']])->names('employee.loans.articles');
        Route::put('loans', 'LoanController@updateState')->name('employee.loans.updateState');

        // Movements
        Route::resource('movements', 'MovementController', ['except' => ['create', 'edit']])->names('employee.movements');

        // Projects
        Route::resource('projects', 'ProjectController', ['except' => ['create']])->names('employee.projects');
        Route::put('projects', 'ProjectController@updateConcept');

        // Update Password
        Route::resource('update-password', 'UpdatePasswordController', ['except' => ['create', 'edit','update', 'destroy']])->names('employee.update-password');

        // Profile
        Route::resource('profile', 'ProfileController', ['except' => ['create', 'edit','update', 'destroy']])->names('employee.profile');

        // Teachers
        Route::resource('teachers', 'TeacherController', ['except' => ['create', 'edit']])->names('employee.teachers');

        // Warehouses
        Route::resource('warehouses', 'WarehouseController', ['except' => ['create', 'edit']])->names('employee.warehouses');
        Route::resource('warehouses/{warehouse}/article', 'Warehouses\ArticleController', ['except' => ['create', 'edit']])->names('employee.warehouses.articles');

    });

    Route::get('select', 'AppController@select')->middleware('ajax');

});

/*Route::get('foo', function () {
   $pdf = PDF::loadView('welcome');
   return $pdf->stream();
});*/
