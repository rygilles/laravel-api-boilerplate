<?php

use Illuminate\Database\Seeder;

class UserGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_group')->insert([
            [
                'id'    => 'Developer',
            ],
            [
                'id'    => 'Support',
            ],
            [
                'id'    => 'End-User',
            ],
        ]);
    }
}
