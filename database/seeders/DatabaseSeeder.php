<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Setting::firstOrCreate(
            ['key' => 'qsn_content'],
            ['value' => 'Bienvenue sur notre plateforme de presse. Nous sommes dédiés à fournir une information fiable et en temps réel...']
        );

        $this->call([
        CategorySeeder::class,
        ArticleSeeder::class,
    ]);

    // On utilise updateOrCreate pour être certain que les accès sont les bons
    \App\Models\User::updateOrCreate(
        ['email' => 'admin@exple.com'], // On cherche par l'email
        [
            'name' => 'Admin',
            'password' => bcrypt('admin123'), // On force le mot de passe
        ]
    );
    }

}
