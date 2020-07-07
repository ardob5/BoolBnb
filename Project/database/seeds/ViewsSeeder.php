<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\View;

class ViewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = Apartment::all();
        foreach ($apartments as $apartment) {
            factory(View::class, 5)->create([
                'apartment_id' => $apartment->id
            ]);
        }
    }
}
