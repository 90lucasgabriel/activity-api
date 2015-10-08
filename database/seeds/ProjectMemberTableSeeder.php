<?php

use Illuminate\Database\Seeder;
use CodeProject\Entities\ProjectMember;

class ProjectMemberTableSeeder extends Seeder
{
    public function run()
    {
        ProjectMember::truncate();
        factory(ProjectMember::class, 50)->create();
    }
}