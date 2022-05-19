<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('subjects')->delete();

        \DB::table('subjects')->insert(array(
            0 =>
                array(
                    'name' => 'Maths'
                ),
            1 =>
                array(
                    'name' => 'Science'
                ),
            2 =>
                array(
                    'name' => 'History'
                ),
        ));
    }
}