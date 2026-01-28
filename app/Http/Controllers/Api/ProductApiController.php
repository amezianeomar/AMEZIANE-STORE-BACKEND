<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Filter by Search (Name)
        if ($request->has('search') && $request->search != '') {
            $query->where('nom', 'LIKE', '%' . $request->search . '%');
        }

        // Filter by Category
        if ($request->has('category') && $request->category != '') {
            $query->where('categorie', $request->category);
        }

        // Filter by Price (Max)
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('prix', '<=', $request->max_price);
        }
        
        // Filter by Price (Min)
        if ($request->has('min_price') && $request->min_price != '') {
             $query->where('prix', '>=', $request->min_price);
        }

        // Pagination (6 per page)
        $products = $query->paginate(6);

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'categorie' => 'required|string',
            'image' => 'required|file|image|max:2048', // Validation image
        ]);

        // Cloudinary Upload
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        try {
            $uploadedFile = $request->file('image')->getRealPath();
            $uploadResult = $cloudinary->uploadApi()->upload($uploadedFile, [
                'folder' => 'ameziane_store_api_test'
            ]);
            $imageUrl = $uploadResult['secure_url'];

            $product = Product::create([
                'nom' => $request->nom,
                'prix' => $request->prix,
                'categorie' => $request->categorie,
                'image' => $imageUrl,
                'desc' => $request->input('desc', ''), // Optional description
            ]);

            return response()->json($product, 201);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Upload failed: ' . $e->getMessage()], 500);
        }
    }
}
