<?php

namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
  
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Mark James',
            'last_name' => 'Aguila', 
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'contact_no' => '1234567'
        ]);
        $user->save();
    
        $role = Role::findOrFail(1);
     
        $user->assignRole([$role->id]);
    }
}