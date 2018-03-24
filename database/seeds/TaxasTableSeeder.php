<?php

use App\Taxas;
use Illuminate\Database\Seeder;

class TaxasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Taxas::create(['id'=>1,'credito'=>0,'creditoavista'=>1,'debito'=>0]);
    }
}
