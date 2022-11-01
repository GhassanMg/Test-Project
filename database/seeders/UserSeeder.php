<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name'    => 'Ghassan',
            'last_name'     => 'Admin',
            'email'         => 'admin@gmail.com',
            'phone_number'  => '0993355478',
            'password'      => 'Admin@2022'
        ]);
        $user->assignRole('admin');
    }
}
