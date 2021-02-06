<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create(
            [
                'name' => 'ahmed ',
                'email' => 'ahmed@gmail.com',
                'phone' => '12345678',
                'password' => bcrypt('ahmed1191'),
            ]);
    }
}
