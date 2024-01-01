<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */


    public function run(): void
    {
        $states = [
            'NONE',
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
        ];
        $safetyBehaviours = [];
        for ($i = 0; $i < count($behaviours); $i++) {
            $safetyBehaviours[$i] = ['title' => $behaviours[$i]];
        }
        $ppes = [
            'Head protection',
            'Eye / Face protection',
            'Respiratory protection',
            'Protective clothing',
            'Hand / arm protection',
            'Feet / ankle protection',
            'Hearing protection',
            'Working at Height PPE',

        ];
        $correctPpes = [];
        for ($i = 0; $i < count($ppes); $i++) {
            $correctPpes[$i] = ['title' => $ppes[$i]];
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
        DB::table('safety_states')->insert($safetyStates);
        DB::table('safety_behaviours')->insert($safetyBehaviours);
        DB::table('correct_ppes')->insert($correctPpes);

        DB::table('unsafe_conditions')->insert($unsafeConditions);
        DB::table('quality_observations')->insert($qualityObservations);
        DB::table('environmental_observations')->insert($environmentalObservations);


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
