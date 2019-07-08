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

        //factory(BeneficiaryLesson::class, 5)->create();
        factory(Category::class, 5)->create();
        factory(Location::class, 5)->create();
        factory(Furniture::class, 5)->create();
        factory(Employee::class, 5)->create();
        factory(FurnitureTransfer::class, 5)->create();
        //factory(BeneficiaryProject::class, 5)->create();
    }
}
