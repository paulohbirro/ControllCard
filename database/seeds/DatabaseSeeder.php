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
        Taxas::create(['id'=>1,'credito'=>0,'creditoavista'=>0,'debito'=>0]);
    }
}

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('TaxasTableSeeder');
    }
}
