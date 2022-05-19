<?php

use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('teachers')->delete();

        \DB::table('teachers')->insert(array(
            0 =>
                array(
                    'name' => 'Teacher1'
                ),
            1 =>
                array(
                    'name' => 'Teacher2'
                ),
            2 =>
                array(
                    'name' => 'Teacher3'
                ),
            3 =>
                array(
                    'name' => 'Teacher4'
                ),
            4 =>
                array(
                    'name' => 'Teacher5'
                ),
        ));
    }
}