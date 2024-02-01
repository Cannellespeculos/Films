<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{ Film, Category, Actor };

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {


        $categories = [
            'Comédie',
            'Drame',
            'Action',
            'Fantastique',
            'Horreur',
            'Animation',
            'Espionnage',
            'Guerre',
            'Policier',
            'Pornographique',
            'Romance',
            'Comédie dramatique',
            'Aventure',
            'Western',
            'Science-fiction',
            'Documentaire',
            'Catastrophe',
            'Historique',
            'Thriller',
            'Erotique',

        ];

        $actors = [
            'Brennan',
            'Cannelle',
            'Joan',
            'Enzo',
            'Ugo',
            'Elevan',
            'Ethan',
            'Lilian',
            'Lana',
            'Darius',
            'Joshua',
            'Thais',
            'Dylan',
            'Loïc',
            'Timothé',
            'Lucas',
            'Chloé',
            'Ambrine',
            'Clément',
            'Noa',
            'Jade',
        ];

        foreach($categories as $category) {
            Category::create(['name' => $category, 'slug' => str()->slug($category)]);
        }

        foreach($actors as $actor) {
            Actor::create(['name' => $actor, 'slug' => str()->slug($actor)]);
        }

        $ids = range(1, 20);
        Film::factory()->count(100)->create()->each(function ($film) use($ids) {
            shuffle($ids);
            $film->categories()->attach(array_slice($ids, 0, rand(1, 4)));
            shuffle($ids);
            $film->actors()->attach(array_slice($ids, 0, rand(1, 4)));
        });
    }
}
