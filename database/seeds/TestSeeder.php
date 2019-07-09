<?php

use App\Beneficiary;
use App\BeneficiaryCourse;
use App\BeneficiaryLesson;
use App\BeneficiaryProject;
use App\Category;
use App\Course;
use App\Employee;
use App\Furniture;
use App\FurnitureTransfer;
use App\Lesson;
use App\Location;
use App\Project;
use App\Teacher;
use App\Transfer;
use App\User;
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
        ])->assignRole('beneficiary');

        factory(Beneficiary::class, 35)->create();
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
                factory(BeneficiaryProject::class)->create([
                    'beneficiary_id' => $beneficiary->id,
                    'project_id' => random_int(1, Project::count()),
                ]);
                factory(BeneficiaryLesson::class)->create([
                    'beneficiary_id' => $beneficiary->id,
                    'lesson_id' => random_int(1, Lesson::count()),
                ]);
            }
        }

        // Teachers
        $teacher = factory(Teacher::class)->create([
            'email' => 'teacher@admin.com'
        ]);

        factory(User::class)->create([
            'name' => $teacher->full_name,
            'email' => $teacher->email,
            'model_type' => 'App\Teacher',
            'model_id' => $teacher->id,
        ])->assignRole('teacher');

        factory(Teacher::class, 35)->create();

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

        // Employees
        $employee = factory(Employee::class)->create([
            'email' => 'employee@admin.com'
        ]);

        factory(User::class)->create([
            'name' => $employee->full_name,
            'email' => $employee->email,
            'model_type' => 'App\Employee',
            'model_id' => $employee->id,
        ])->assignRole('employee');

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

        //factory(BeneficiaryLesson::class, 5)->create();
        factory(Category::class, 5)->create();
        factory(Location::class, 5)->create();
        factory(Furniture::class, 5)->create();
        //factory(Employee::class, 5)->create();
        //factory(FurnitureTransfer::class, 5)->create();
        //factory(BeneficiaryProject::class, 5)->create();
    }
}
