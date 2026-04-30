<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $categories = Category::all();

        $posts = [
            [
                'title'        => 'Introduction à Laravel 11',
                'slug'         => 'introduction-laravel-11',
                'body'         => 'Laravel est un framework PHP élégant et expressif. Dans cet article nous allons découvrir les nouveautés de Laravel 11 et comment bien démarrer avec ce framework puissant.',
                'category_id'  => $categories[2]->id,
                'published_at' => now()->subDays(1),
            ],
            [
                'title'        => 'Tailwind CSS — Guide complet',
                'slug'         => 'tailwind-css-guide-complet',
                'body'         => 'Tailwind CSS est un framework CSS utilitaire qui permet de créer des interfaces modernes rapidement. Découvrez comment l\'utiliser efficacement dans vos projets.',
                'category_id'  => $categories[3]->id,
                'published_at' => now()->subDays(2),
            ],
            [
                'title'        => 'Les tendances du design web en 2026',
                'slug'         => 'tendances-design-web-2026',
                'body'         => 'Le design web évolue constamment. En 2026, on observe de nouvelles tendances comme le glassmorphisme, les dégradés vibrants et les interfaces minimalistes.',
                'category_id'  => $categories[1]->id,
                'published_at' => now()->subDays(3),
            ],
            [
                'title'        => 'Intelligence artificielle et développement',
                'slug'         => 'ia-et-developpement',
                'body'         => 'L\'IA transforme le monde du développement web. Des outils comme GitHub Copilot ou Claude permettent aux développeurs d\'être plus productifs.',
                'category_id'  => $categories[0]->id,
                'published_at' => now()->subDays(4),
            ],
            [
                'title'        => 'Créer une API REST avec Laravel',
                'slug'         => 'api-rest-laravel',
                'body'         => 'Dans ce tutoriel nous allons créer une API REST complète avec Laravel. Nous verrons les controllers, les resources, les validations et bien plus encore.',
                'category_id'  => $categories[2]->id,
                'published_at' => now()->subDays(5),
            ],
            [
                'title'        => 'Les meilleures pratiques PHP en 2026',
                'slug'         => 'meilleures-pratiques-php-2026',
                'body'         => 'PHP continue d\'évoluer et les bonnes pratiques aussi. Découvrez les patterns modernes, les outils de qualité de code et comment écrire du PHP propre et maintenable.',
                'category_id'  => $categories[0]->id,
                'published_at' => now()->subDays(6),
            ],
        ];

        foreach ($posts as $post) {
            Post::create(array_merge($post, ['user_id' => $user->id]));
        }
    }
}