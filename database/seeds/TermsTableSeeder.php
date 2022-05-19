<?php

use Illuminate\Database\Seeder;

class TermsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('terms')->delete();

        \DB::table('terms')->insert(array(
            0 =>
                array(
                    'name' => 'Term1'
                ),
            1 =>
                array(
                    'name' => 'Term2'
                ),
            2 =>
                array(
                    'name' => 'Term3'
                ),
        ));
    }
}