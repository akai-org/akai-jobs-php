<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'first_name' => 'Test',
                'last_name' => 'Testowski',
                'password' => bcrypt('test123'),
                'email' => 'test@test.pl',
                'phone' => '123234345',
                'address_id' => 1,
                'degree_id' => 2,
                'email_verified_at' => Carbon::now(),
                'company_id' => 3
            ]
        ]);
    }
}
