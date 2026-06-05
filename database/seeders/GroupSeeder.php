<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        $groups = ['21BQ-1',  '21BQ-2','21JA-1','21JA-2','22BQ-1','22BQ-2',];

        foreach ($groups as $name) {
            Group::create(['name' => $name]);
        }
    }
}

