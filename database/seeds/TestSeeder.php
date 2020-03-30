<?php

use App\Article;
use App\Beneficiary;
use App\BeneficiaryCourse;
use App\BeneficiaryLesson;
use App\Category;
use App\Course;
use App\Employee;
use App\Format;
use App\Furniture;
use App\Lesson;
use App\Location;
use App\Member;
use App\Project;
use App\Teacher;
use App\Transfer;
use App\User;
use App\Warehouse;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        // Beneficiaries
        $beneficiary = factory(Beneficiary::class)->create([
            'email' => 'beneficiary@admin.com'
        ]);

        factory(User::class)->create([
            'name' => $beneficiary->full_name,
            'email' => $beneficiary->email,
            'model_type' => 'App\Beneficiary',
            'model_id' => $beneficiary->id,
        ])->assignRole('beneficiaries');

        // Teachers
        $teacher = factory(Teacher::class)->create([
            'email' => 'teacher@admin.com'
        ]);

        factory(User::class)->create([
            'name' => $teacher->full_name,
            'email' => $teacher->email,
            'model_type' => 'App\Teacher',
            'model_id' => $teacher->id,
        ])->assignRole('teachers');

        // Employees
        $employee = factory(Employee::class)->create([
            'email' => 'employee@admin.com'
        ]);

        factory(User::class)->create([
            'name' => $employee->full_name,
            'email' => $employee->email,
            'model_type' => 'App\Employee',
            'model_id' => $employee->id,
        ])->assignRole('employees');

        $teachers = Teacher::all();

        foreach ($teachers as $teacher) {
            for ($i = 0; $i < random_int(1, 10); $i++) {
                factory(Course::class)->create([
                    'teacher_id' => $teacher->id,
                ]);
            }
        }

        $courses = Course::all();

        foreach ($courses as $course) {
            for ($i = 0; $i < random_int(1, 10); $i++) {
                factory(Lesson::class)->create([
                    'course_id' => $course->id,
                ]);
            }
        }

        factory(Beneficiary::class, 25)->create();
        factory(Course::class, 10)->create();
        factory(Project::class, 10)->create();
        factory(Lesson::class, 10)->create();

        $beneficiaries = Beneficiary::all();

        foreach ($beneficiaries as $beneficiary) {
            for ($i = 0; $i < random_int(1, 10); $i++) {
                factory(BeneficiaryCourse::class)->create([
                    'beneficiary_id' => $beneficiary->id,
                    'course_id' => random_int(1, Course::count()),
                ]);
                factory(Project::class)->create([
                    'beneficiary_id' => $beneficiary->id,
                ]);
                factory(BeneficiaryLesson::class)->create([
                    'beneficiary_id' => $beneficiary->id,
                    'lesson_id' => random_int(1, Lesson::count()),
                ]);
            }
        }

        factory(Employee::class, 25)->create();

        $employees = Employee::all();

        foreach ($employees as $employee) {
            for ($i = 0; $i < random_int(1, 10); $i++) {
                factory(Transfer::class)->create([
                    'employee_id' => $employee->id,
                ]);
            }
            for ($i = 0; $i < random_int(1, 10); $i++) {
                factory(Project::class)->create([
                    'employee_id' => $employee->id,
                ]);
            }
        }

        $projects = Project::all();

        foreach ($projects as $project) {
            for ($i = 0; $i < random_int(1, 10); $i++) {
                factory(Member::class)->create([
                    'project_id' => $project->id,
                ]);
            }
        }

        factory(Format::class)->create([
            'name' => "Autorización de uso de derecho de imagen y fotografías y fijaciones audiovisuales (Videos) PTV"
        ]);

        factory(Format::class)->create([
            'name' => "Acuerdo de responsabilidad en prestamo de equipos"
        ]);

        factory(Format::class)->create([
            'name' => "Salida de equipos"
        ]);

        //factory(BeneficiaryLesson::class, 5)->create();
        factory(Category::class, 5)->create();
        factory(Location::class, 5)->create();
        factory(Furniture::class, 5)->create();
        //factory(Employee::class, 5)->create();
        //factory(FurnitureTransfer::class, 5)->create();
        //factory(BeneficiaryProject::class, 5)->create();
        factory(Warehouse::class, 10)->create();
        factory(Article::class, 10)->create();
    }
}
