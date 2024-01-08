<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */


    public function run(): void
    {
        User::factory(10)->create();



        $roles = [
            'guest',
            'crew',
            'hod',
            'hse',
            'admin',
        ];

        $bargeRoles = [];
        for ($i = 0; $i < count($roles); $i++) {
            $bargeRoles[$i] = ['title' => $roles[$i]];
        }

        $statuses = [
            'new',
            'in progress',
            'postponed',
            'canceled',
            'closed',
        ];

        $bargeStatuses = [];
        for ($i = 0; $i < count($statuses); $i++) {
            $bargeStatuses[$i] = ['title' => $statuses[$i]];
        }

        $departments = [
            'Vessel',
            'Deck',
            'Engine',
            'Electrical',
            'LayTech',
            'Catering'
        ];

        $bargeDepartments = [];
        for ($i = 0; $i < count($departments); $i++) {
            $bargeDepartments[$i] = ['title' => $departments[$i]];
        }

        $states = [
            'SAFE',
            'AT RISK'
        ];
        $safetyStates = [];
        for ($i = 0; $i < count($states); $i++) {
            $safetyStates[$i] = ['title' => $states[$i]];
        }

        $behaviours = [
            'Eyes on path',
            'Line of fire',
            'Use of tools and equipment',
            'Pinch points',
            '3-point contact',
            'Communication',
            'Housekeeping',
            'Pre-job planning',
            'Assistance needed/used',
            'Walking/working surfaces',
            'Eyes on Task',
            'Hot-work preparation',
            'Manual handling',
            'Lock-out / tag out system / isolation of energy',
            'Use of barriers and warnings',
            'Conformance to rules/procedures/policies',
            'Immediate reporting of injury',
            'Correct PPE worn for the risk',
            'Head protection',
            'Eye / Face protection',
            'Respiratory protection',
            'Protective clothing',
            'Hand / arm protection',
            'Feet / ankle protection',
            'Hearing protection',
            'Working at Height PPE',
        ];
        $safetyBehaviours = [];
        for ($i = 0; $i < count($behaviours); $i++) {
            $safetyBehaviours[$i] = ['title' => $behaviours[$i]];
        }


        $unsafes = [
            'Warning system inadequate',
            'Defective tools/equipment/materials',
            'Inadequate guards and barriers',
            'Inadequate working environment (light, ventilation, noise)',
            'Fire and explosion hazard',
            'Extreme weather conditions',
            'Inadequate layout of workplace',
            'Poor housekeeping',
            'Correct protective equipment not available',
            'Slippery or uneven surface',
            'Misplaced/loose object with potential to fall',
            '3rd party activities',
            'Maintenance',
        ];
        $unsafeConditions = [];
        for ($i = 0; $i < count($unsafes); $i++) {
            $unsafeConditions[$i] = ['title' => $unsafes[$i]];
        }

        $qualities = [
            'Procedures/work instruction issue',
            'Equipment/material issue',
            'Certification issue',
            'Planning/scheduling ineffective',
            'Training/induction inadequate',
            'Improvement suggestion',
        ];
        $qualityObservations = [];
        for ($i = 0; $i < count($qualities); $i++) {
            $qualityObservations[$i] = ['title' => $qualities[$i]];
        }

        $environmentals = [
            'Spill/release to air, sea, land potential',
            'Material storage inadequate',
            'Waste disposal inadequate',
            'Energy management inefficient',
        ];
        $environmentalObservations = [];
        for ($i = 0; $i < count($environmentals); $i++) {
            $environmentalObservations[$i] = ['title' => $environmentals[$i]];
        }

        // \App\Models\User::factory(10)->create();
        DB::table('statuses')->insert($bargeStatuses);
        DB::table('roles')->insert($bargeRoles);
        DB::table('departments')->insert($bargeDepartments);

        DB::table('safety_states')->insert($safetyStates);
        DB::table('safety_behaviours')->insert($safetyBehaviours);

        DB::table('unsafe_conditions')->insert($unsafeConditions);
        DB::table('quality_observations')->insert($qualityObservations);
        DB::table('environmental_observations')->insert($environmentalObservations);


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
