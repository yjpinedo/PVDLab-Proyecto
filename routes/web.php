<?php

use App\Utils\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::redirect('/', 'home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('home', 'HomeController@index')->name('home');


    Route::resource('teachers', 'TeacherController', ['except' => ['create', 'edit']]);
    Route::resource('beneficiaries', 'BeneficiaryController', ['except' => ['create', 'edit']]);
    Route::resource('courses', 'CourseController', ['except' => ['create', 'edit']]);
    Route::resource('lessons', 'LessonController', ['except' => ['create', 'edit']]);
    Route::resource('beneficiary_courses', 'BeneficiaryCourseController', ['except' => ['create', 'edit']]);
    Route::resource('beneficiary_lessons', 'BeneficiaryLessonController', ['except' => ['create', 'edit']]);
    Route::resource('categories', 'CategoryController', ['except' => ['create', 'edit']]);
    Route::resource('locations', 'LocationController', ['except' => ['create', 'edit']]);
    Route::resource('furniture', 'FurnitureController', ['except' => ['create', 'edit']]);
    Route::resource('positions', 'PositionController', ['except' => ['create', 'edit']]);
    Route::resource('employees', 'EmployeeController', ['except' => ['create', 'edit']]);
    Route::resource('projects', 'ProjectController', ['except' => ['create', 'edit']]);
    Route::resource('beneficiary_projects', 'BeneficiaryProjectController', ['except' => ['create', 'edit']]);
    Route::resource('transfers', 'TransferController', ['except' => ['create', 'edit']]);
    Route::resource('furniture_transfers', 'FurnitureTransferController', ['except' => ['create', 'edit']]);

    Route::get('select', function (Request $request) {
        $request->request->add(['data' => Base::select($request->input('name'))]);

        return response()->json($request);
    })->middleware('ajax');
});

