<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin',
            'password' => bcrypt('admin'),
            'is_admin' => true,
        ]);
        \App\Models\User::factory(5)->create();

        $organizations = \App\Models\Organization::factory(50)->create();
        
        foreach ($organizations as $organization ) {
            $total = 10;
            for ($i=0; $i <= $total; $i++) { 
                \App\Models\Position::create([
                    'name' => $faker->jobTitle(),  
                    'organization_id' => $organization->id,   
                ]);
            }
        }

    }
}
