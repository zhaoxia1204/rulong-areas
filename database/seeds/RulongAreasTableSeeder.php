<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RulongAreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $SQL = file_get_contents(__DIR__ . '/database_seeder.stub');
        DB::statement($SQL);
    }
}
