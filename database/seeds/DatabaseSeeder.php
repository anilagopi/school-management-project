<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Schema::disableForeignKeyConstraints();

         $this->call(UsersTableSeeder::class);
         $this->call(TeachersTableSeeder::class);
         $this->call(TermsTableSeeder::class);
         $this->call(SubjectsTableSeeder::class);

        Schema::EnableForeignKeyConstraints();
    }
}
