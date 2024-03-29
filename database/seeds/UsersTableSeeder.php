<?php

use App\Employee;
use App\Position;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table((new User)->getTable())->delete();

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'beneficiaries']);
        Role::create(['name' => 'teachers']);
        Role::create(['name' => 'employees']);

        factory(Position::class, 1)->create([
            'code' => 'CAR - 1',
            'name' => 'Administrador',
            'description' => 'Permite administrar todas las funcionalidades del sistema.',
        ]);

        $employee = factory(Employee::class)->create([
            'email' => 'admin@admin.com'
        ]);

        factory(User::class)->create([
            'name' => $employee->full_name,
            'email' => $employee->email,
            'model_type' => 'App\Employee',
            'model_id' => $employee->id,
            'password' => bcrypt('A9b8C7d6E5f4G3h2*'),
        ])->assignRole('admin');

        Model::reguard();
    }
}
