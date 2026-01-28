<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::truncate();

        // READ DATA FROM JSON FILE
        $json = file_get_contents(base_path('products-pictures.json'));
        $data = json_decode($json, true);

        if (!$data) {
            $this->command->error("Erreur de lecture du fichier products-pictures.json !");
            return;
        }

        foreach ($data as $cat => $products) {
            foreach ($products as $product) {
                Product::create([
                    'nom' => $product['name'],
                    'prix' => rand(300, 15000),
                    'image' => $product['img'],
                    'desc' => "Découvrez le {$product['name']}. Une expérience de jeu immersive avec des performances de pointe pour les passionnés.",
                    'categorie' => $cat
                ]);
            }
        }
    }

    private function getImageForCategory($cat, $i)
    {
        // "Genius Way" : Utiliser un service de placeholder qui génère une image AVEC LE TEXTE du produit.
        // Cela permet d'avoir "visuellement" le bon produit sans chercher 72 images manuellement.
        // On récupère le nom du produit depuis la liste $data si possible, ou on génère un générique.
        
        // Pour faire simple ici, on va devoir tricher un peu car cette méthode n'a que l'index $i.
        // Mais attendez, on peut passer le NOM en paramètre au lieu de $i !
        return "https://placehold.co/600x400/1a0b2e/00ff00?text=" . urlencode("Produit $i");
    }
}