<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Member::firstOrCreate(
            ['email' => 'ahmed.benali@rplsefrou.ma'],
            [
                'name' => 'Ahmed Benali',
                'phone' => '+212 6 12 34 56 78',
                'bio' => 'Passionné par le patrimoine culturel de Sefrou et engagé dans la promotion du tourisme local.',
                'position' => 'Président',
                'is_active' => true,
                'joined_at' => now()->subYears(2),
            ]
        );

        Member::firstOrCreate(
            ['email' => 'fatima.alaoui@rplsefrou.ma'],
            [
                'name' => 'Fatima Alaoui',
                'phone' => '+212 6 23 45 67 89',
                'bio' => 'Spécialiste en communication et événementiel, elle organise les activités culturelles de l\'association.',
                'position' => 'Vice-Présidente',
                'is_active' => true,
                'joined_at' => now()->subYear(),
            ]
        );

        Member::firstOrCreate(
            ['email' => 'mohamed.tazi@rplsefrou.ma'],
            [
                'name' => 'Mohamed Tazi',
                'phone' => '+212 6 34 56 78 90',
                'bio' => 'Historien local et guide touristique, il partage sa connaissance approfondie de Sefrou.',
                'position' => 'Secrétaire',
                'is_active' => true,
                'joined_at' => now()->subMonths(6),
            ]
        );

        Member::firstOrCreate(
            ['email' => 'aicha.berrada@rplsefrou.ma'],
            [
                'name' => 'Aicha Berrada',
                'phone' => '+212 6 45 67 89 01',
                'bio' => 'Artiste et artisan, elle contribue à la préservation des traditions artisanales de la région.',
                'position' => 'Trésorière',
                'is_active' => true,
                'joined_at' => now()->subMonths(3),
            ]
        );
    }
}
