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
        Route::resource('responsibility', 'ResponsibilityController');


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


Route::get('foo', function () {
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML('<!DOCTYPE html><html><head> <title></title> <meta http-equiv="content-type" content="text/html; charset=utf-8" /> <meta name="author" content="ADMINISTRACION" /> <meta name="lastsavedby" content="ADMINISTRACION" /> <meta name="datecontentcreated" content="2017-12-28T15:59:00Z" /> <meta name="datelastsaved" content="2017-12-28T16:06:00Z" /> <meta name="application" content="Microsoft Office Word" /></head><style> .cod{ font-size: 10px; } .co{ text-align: center; font-size: 12px; } .cc{margin-left: 90px;} p{text-align: justify} img{ margin-left: 30px; margin-right: 30px; }</style><body> <table border="1" cellspacing="0" cellpadding="0"> <tbody> <tr> <td rowspan="3"> &nbsp;&nbsp;&nbsp;<span><img style="margin-top: 10px;" src="{{ asset("img/1327e65e.png") }} width="150" height="50""></span><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><img src="TPgi8o51_files/Image2.png" width="90" height="30" ></span> </td> <td rowspan="2"> <p class="co">PUNTO VIVE DIGITAL LAB VALLEDUPAR</p> </td> <td> <p class="cod">CÓDIGO: PVDLAB-FOR05</p> </td> </tr> <tr> <td> <p class="cod">VERSIÓN: 3</p> </td> </tr> <tr> <td valign="top"> <p class="co">FORMATO DE ACUERDO DE RESPONSABILIDAD EN PRÉSTAMO DE EQUIPOS</p> </td> <td> <p class="cod">FECHA: DICIEMBRE 2017</p> </td> </tr> </tbody> </table> <br /> <p>Entre los suscritos a saber: Por una parte_______________________________________, mayor de edad, identificado(a) con C.C. No. _____________________________ expedida en ___________________, Quien se denomina <b>EL</b> <b>BENEFICIARIO</b>, quien recibe en calidad de préstamo, y por otra parte _____________________________________________________________________, en representación del Punto Vive Digital Lab Valledupar, también mayor de edad, identificado(a) con C.C. No. ________________________________, expedida en ________________________________, quien se denomina <b>PVDLAB VALLEDUPAR</b>, se realiza el préstamo de equipos para uso dentro y/o fuera de las instalaciones del punto. Dicho préstamo se rige por las siguientes clausulas: </p> <p><b>PRIMERO: OBJETO</b>; El Objeto del presente préstamo es con el fin de que <b>EL BENEFICIARIO</b> (quien recibe en calidad de préstamo los equipos y accesorios que se describen en la cláusula Cuarta), desarrolle los proyectos audiovisuales denominados: Largometraje “La Frontera” y el Cortometraje “ Paco: La Fábula” con el apoyo del <b>PVDLAB VALLEDUPAR</b>. </p> <p><b>SEGUNDO: BUEN USO</b>; <b>EL BENEFICIARIO, </b>se responsabiliza a darle uso pertinente a los equipos que recibe en calidad de préstamo y se hace responsable por cualquier pérdida o daño que afecte el buen uso de los mismos. </p> <p><b>TERCERO: AUDITORIA E INSPECCIÓN</b>; <b>EL PVDLAB VALLEDUPAR</b>, se reserva el derecho para hacer Auditoría e Inspección a los equipos que preste y que le pertenecen, pudiendo quitar los equipos de su propiedad por riesgo de daño, o mal uso que se le den a sus equipos, so pena de iniciar acciones legales si por culpa o descuido se haga mal uso, o se cause daño a los equipos por parte de <b>EL BENEFICIARIO</b> </p> <p><b>CUARTO</b>: <b>DESCRIPCIÓN DEL (LOS) EQUIPO (S)</b>: </p> <p><b>QUINTO: RESPONSABILIDAD SOLIDARIA</b>; <b>EL BENEFICIARIO</b>, se hace responsable solidariamente por los daños que cause al(los) equipo(s) que recibe en calidad de préstamo del <b>PVDLAB VALLEDUPAR </b>y que por su culpa u omisión de cuidado sufra el equipo de propiedad de <b>EL BENEFICIARIO</b>, el cual prestará merito ejecutivo, con base al Art. 422 del Nuevo Código General del Proceso.</p> <p>Dado en Valledupar, a los ________ días del mes de ____________________________________.</p> <br> <p class="cc"><b>&nbsp;&nbsp;EL BENEFICIARIO</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;por el <b>PVDLAB VALLEDUPAR </b></p> <p class="cc">_____________________________ &nbsp;&nbsp;&nbsp;_________________________________</p><p class="cc">C.C. No. ______________________ C.C. No. __________________________</p> <br><p style="text-align: center">Nota: El Documento debe llevar Huella de quien recibe y debe dejar fotocopia de Cédula al 200%.</p> <br /></body></html>');
    return $pdf->stream();
});
