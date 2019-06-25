<?php

use App\BeneficiaryCourse;
use App\BeneficiaryLesson;
use App\BeneficiaryProject;
use App\Category;
use App\Employee;
use App\Furniture;
use App\FurnitureTransfer;
use App\Location;
use App\Project;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(BeneficiaryCourse::class, 5)->create();
        factory(BeneficiaryLesson::class, 5)->create();
        factory(Category::class, 5)->create();
        factory(Location::class, 5)->create();
        factory(Furniture::class, 5)->create();
        factory(Employee::class, 5)->create();
        factory(Project::class, 5)->create();
        factory(FurnitureTransfer::class, 5)->create();
        factory(BeneficiaryProject::class, 5)->create();
    }
}
