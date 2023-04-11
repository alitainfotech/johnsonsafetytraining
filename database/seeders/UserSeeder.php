<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $users = [
            'full_name' => 'Master Admin',
            'user_name' => 'admin',
            'email' => 'admin@gmail.com',
            'Types' => '0',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('password'),
            'status' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        User::insert($users);
    }
}
