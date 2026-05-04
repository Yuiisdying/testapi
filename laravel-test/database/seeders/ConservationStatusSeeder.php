<?php

namespace Database\Seeders;

use App\Models\ConservationStatus;
use Illuminate\Database\Seeder;

class ConservationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name' => 'Least Concern',
                'description' => 'Widespread and abundant, no immediate threat',
                'color_code' => '#28a745',
                'risk_level' => 0,
            ],
            [
                'name' => 'Vulnerable',
                'description' => 'Facing moderate risks, declining populations',
                'color_code' => '#ffc107',
                'risk_level' => 2,
            ],
            [
                'name' => 'Endangered',
                'description' => 'Facing high risk of extinction',
                'color_code' => '#fd7e14',
                'risk_level' => 3,
            ],
            [
                'name' => 'Critically Endangered',
                'description' => 'Facing extremely high risk of extinction',
                'color_code' => '#dc3545',
                'risk_level' => 4,
            ],
            [
                'name' => 'Extinct in the Wild',
                'description' => 'Only exists in captivity or cultivation',
                'color_code' => '#6c757d',
                'risk_level' => 5,
            ],
        ];

        foreach ($statuses as $status) {
            ConservationStatus::create($status);
        }
    }
}
