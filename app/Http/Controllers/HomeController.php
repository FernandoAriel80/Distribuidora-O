<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'sort' => 'nullable|in:asc,desc'
        ]);
    
        $search = (string) $request->input('search', '');
        $category = (string) $request->input('category', '');
        $sort = $request->input('sort', 'asc');

        try {
            $query = Product::with(['type', 'category']);

            if ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            }
            if ($category) {
                $query->whereHas('category', function($q) use ($category) {
                    $q->where('name', 'like', '%' . $category . '%');
                });
            }

            $query->orderBy('unit_price', $sort);
               // Paginación: 10 productos por página
            $products = $query->paginate(5);
            //$products = $query->get();
            $categories = Category::all('id','name');
            //dd($products);
            return Inertia::render('Home', [
                'products' => $products,
                'categories' => $categories,
                'searchTerm' => $search,
                'categoryTerm' => $category,
                'sortOrder' => $sort
                
            ]); 
        } catch (\Exception $e) {
            return back()->withErrors('Error al obtener producto.');
        }
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
