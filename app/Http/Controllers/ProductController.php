<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Récupère les produits par catégorie
     *
     * @param string $cat
     * @return \Illuminate\View\View
     */
    public function getProductsByCategorie($cat)
    {
        // Pagination : 6 produits par page
        $products = Product::where('categorie', $cat)->paginate(6);

        if ($products->isEmpty()) {
            abort(404);
        }

        // On passe 'liste' et 'titre'
        return view('Produits', [
            'titre' => ucfirst($cat),
            'liste' => $products
        ]);
    }

    /**
     * Affiche les détails d'un produit
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('Produits.show', ['product' => $product]);
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('Produits.create');
    }

    /**
     * Enregistre un nouveau produit
     */
    public function store(\App\Http\Requests\AddProductRequest $request)
    {
        // 1. Initialisation de Cloudinary
        $cloudinary = new \Cloudinary\Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        // 2. Upload de l'image
        $uploadedFile = $request->file('image')->getRealPath();
        $uploadResult = $cloudinary->uploadApi()->upload($uploadedFile, [
            'folder' => 'ameziane_store_products'
        ]);

        // 3. Récupération de l'URL sécurisée
        $imageUrl = $uploadResult['secure_url'];

        // 4. Création du produit en Base de Données
        Product::create([
            'nom' => $request->input('nom'),
            'prix' => $request->input('prix'),
            'categorie' => $request->input('categorie'),
            'desc' => $request->input('desc'),
            'image' => $imageUrl
        ]);

        // 5. Redirection avec les détails pour le Modal "Godly"
        return redirect()->route('produits.create')->with([
            'success' => 'Produit ajouté avec succès !',
            'product_name' => $request->input('nom'),
            'product_image' => $imageUrl
        ]);
        }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('Produits.edit', ['product' => $product]);
    }

    /**
     * Met à jour un produit existant
     */
    public function update(\App\Http\Requests\AddProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        
        // 1. Gestion de l'image (Si nouvelle image uploadée)
        if ($request->hasFile('image')) {
            // Config Cloudinary
            $cloudinary = new \Cloudinary\Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
                'url' => [
                    'secure' => true
                ]
            ]);

            // Upload
            $uploadedFile = $request->file('image')->getRealPath();
            $uploadResult = $cloudinary->uploadApi()->upload($uploadedFile, [
                'folder' => 'ameziane_store_products'
            ]);
            
            // Mise à jour de l'URL
            $product->image = $uploadResult['secure_url'];
        }

        // 2. Mise à jour des autres champs
        $product->nom = $request->input('nom');
        $product->prix = $request->input('prix');
        $product->categorie = $request->input('categorie');
        $product->desc = $request->input('desc');

        $product->save();

        // 3. Redirection avec Modal "Patché"
        return redirect()->route('admin.products')->with('success', 'Produit mis à jour avec succès (Patch v'.rand(1,9).'.0 appliqué) !');
    }

    /**
     * Supprime un produit
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Produit supprimé du catalogue (Ban Hammer appliqué) !');
    }

    // --- GOD MODE (ADMIN) ---

    /**
     * Table de bord Administrateur
     */
    public function adminDashboard()
    {
        return view('Admin.dashboard');
    }

    /**
     * Liste des produits (Tableau + Filtres)
     */
    public function adminIndex(Request $request)
    {
        $query = Product::query();

        // Filtre par catégorie
        if ($request->has('category') && $request->category != '') {
            $query->where('categorie', $request->category);
        }

        // Filtre par recherche
        if ($request->has('search') && $request->search != '') {
            $query->where('nom', 'LIKE', '%' . $request->search . '%');
        }

        $products = $query->paginate(10);

        return view('Admin.index', ['products' => $products]);
    }
}

