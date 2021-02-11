<?php

use App\Article;
use App\ArticleWarehouse;
use App\Beneficiary;
use App\BeneficiaryCourse;
use App\BeneficiaryLesson;
use App\Category;
use App\Course;
use App\Employee;
use App\Existing;
use App\Format;
use App\Furniture;
use App\Lesson;
use App\Location;
use App\Member;
use App\Movement;
use App\Position;
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

        factory(Teacher::class, 3)->create();
        factory(Employee::class, 3)->create();
        factory(Beneficiary::class, 49)->create();

        $teachers = Teacher::all();

        foreach ($teachers as $teacher){
            factory(Course::class, 10)->create([
                'teacher_id' => $teacher->id,
            ])->each(function ($course){
                for ($i = 0; $i < 26; $i++){
                    $course->beneficiaries()->attach(Beneficiary::all()->random()->id);
                }
                factory(Lesson::class, 10)->create([
                    'course_id' => $course->id,
                ])->each(function ($lesson){
                    for ($i = 0; $i < 26; $i++){
                        $lesson->beneficiaries()->attach(Beneficiary::all()->random()->id);
                    }
                });
            });
        }

        /*$courses = Course::all();

        foreach ($courses as $course) {

        }*/

        $beneficiaries = Beneficiary::all();

        foreach ($beneficiaries as $beneficiary){
            factory(Project::class, 5)->create([
                'beneficiary_id' => $beneficiary->id,
                'employee_id' => rand(1,5),
            ])->each(function ($project){
                factory(Member::class, 5)->create([
                    'project_id' => $project->id
                ]);
            });
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

        factory(Category::class, 5)->create()->each(function ($category){
            factory(Article::class, 10)->create([
                'category_id' => $category->id
            ]);
        });

        factory(Warehouse::class, 10)->create()->each(function ($warehouse){
            for ($i = 0; $i < 16; $i++){
                $warehouse->articles()->attach(Article::all()->random()->id, ['stock' => rand(0,100)]);
                factory(Movement::class)->create();
            }
        });

        factory(\App\Loan::class, 100)->create();
    }
}
