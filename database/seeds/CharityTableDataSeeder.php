<?php

use Carbon\Carbon;
use App\Charity;

use Illuminate\Database\Seeder;

class CharityTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $locations = array('Los Angeles, CA',
                           'San Francisco, CA',
                           'New York, NY',
                           'Olathe, KS',
                            'Miami, FL',
                            'Austin, TX',
                            'Las Vegas, NV',
                            'Seattle, WA',
                            'Pittsbug, PA',
                            'San Diego, CA',
                            'Phoenix,AZ');

        $months = range(1,7);

        $goals = range(10000,1000000, 5000);


        for ($i=1; $i < 11; $i++) {

            $name = 'Charity ' . $i;
            $description = 'This is '. $name. ' created to raise awareness';
            $location = $locations[array_rand($locations)];

            $random_month = $months[array_rand($months)];

            $date = Carbon::create(2019, $random_month, 1, 0, 0, 0);
            $start_date = $date->format('Y-m-d H:i:s');
            $end_date = $date->addWeeks(rand(1, 52))->format('Y-m-d H:i:s');

            $goal = $goals[array_rand($goals)];

            Charity::create([
                'name' => $name,
                'description' => $description,
                'location' => $location,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'goal' => $goal,
                'pledged' => 0,
                'donors' => 0
            ]);

        }
    }
}
