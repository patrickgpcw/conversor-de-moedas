<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->baseBRL();
        $this->baseUSD();
        $this->baseEUR();
    }

    private function baseBRL()
    {
        DB::table('currencies')->insert([
            'base' => 'BRL',
            'to' => 'USD',
            'value' => 0.2,
        ]);

        DB::table('currencies')->insert([
            'base' => 'BRL',
            'to' => 'EUR',
            'value' => 0.17,
        ]);
    }

    private function baseUSD()
    {
        DB::table('currencies')->insert([
            'base' => 'USD',
            'to' => 'BRL',
            'value' => 5.04,
        ]);

        DB::table('currencies')->insert([
            'base' => 'USD',
            'to' => 'EUR',
            'value' => 0.84,
        ]);
    }

    private function baseEUR() 
    {
        DB::table('currencies')->insert([
            'base' => 'EUR',
            'to' => 'BRL',
            'value' => 5.98,
        ]);
        
        DB::table('currencies')->insert([
            'base' => 'EUR',
            'to' => 'USD',
            'value' => 1.19,
        ]);
    }
}
