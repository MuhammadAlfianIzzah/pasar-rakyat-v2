<?php

namespace Database\Seeders;

use App\Models\UserGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["nama" => "admin", "slug" => "admin", "id" => 1],
            ["nama" => "vendor", "slug" => "vendor", "id" => 2],
            ["nama" => "user", "slug" => "user", "id" => 3],
            ["nama" => "superadmin", "slug" => "superadmin", "id" => 99],
        ];
        UserGroup::insert($data);
    }
}
