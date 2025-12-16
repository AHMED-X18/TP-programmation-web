<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); 
        Product::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $products = [
            [
                'name' => 'T-shirt Performance Pro',
                'description' => 'T-shirt technique respirant avec technologie anti-transpiration pour vos entraînements intenses.',
                'price' => 19650,
                'image' => 'ballon.jpeg', 
                'stock' => 50,
                'category' => 'Vêtements',
            ],
            [
                'name' => 'Chaussures Running Elite',
                'description' => 'Chaussures de course haute performance avec amorti réactif pour marathon et sprint.',
                'price' => 85250,
                'image' => 'ballon.jpeg',
                'stock' => 20,
                'category' => 'Chaussures',
            ],
            [
                'name' => 'Legging Compression Pro',
                'description' => 'Legging de compression pour femme avec support musculaire optimal.',
                'price' => 32800,
                'image' => 'godasse.jpeg',
                'stock' => 30,
                'category' => 'Femmes',
            ],
            [
                'name' => 'Sac de Sport Premium',
                'description' => 'Sac de sport multifonction avec compartiments séparés pour chaussures et vêtements humides.',
                'price' => 26250,
                'image' => 'godasse.jpeg',
                'stock' => 15,
                'category' => 'Materiel',
            ],
            [
                'name' => 'Short Training Flex',
                'description' => 'Short d\'entraînement ultra-confortable avec technologie stretch 4 directions.',
                'price' => 16400,
                'image' => 'sport.jpg',
                'stock' => 40,
                'category' => 'Hommes',
            ],
            [
                'name' => 'Gourde Isotherme 750ml',
                'description' => 'Gourde isotherme en acier inoxydable, maintient la température pendant 12h.',
                'price' => 13100,
                'image' => 'ballon.jpeg',
                'stock' => 60,
                'category' => 'Materiel',
            ],
            [
                'name' => 'Veste Coupe-Vent UltraLéger',
                'description' => 'Veste coupe-vent imperméable et respirante, idéale pour la course par temps frais.',
                'price' => 45900,
                'image' => 'sport.jpg',
                'stock' => 25,
                'category' => 'Materiel',
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}