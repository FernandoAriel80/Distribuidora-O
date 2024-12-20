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
            'sort' => 'nullable|'
        ]);
    
        $search = (string) $request->input('search', '');
        $category = (string) $request->input('category', '');
        $sort = $request->input('sort','rel');

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
            if ($sort == 'rel') {
                $query->orderBy('updated_at', 'desc');
            }else if ($sort == 'lPrice') {
                $query->orderBy('unit_price', 'asc');
            }else if ($sort == 'hPrice') {
                $query->orderBy('unit_price', 'desc');
            }

            $products = $query->paginate(10)->withQueryString();
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
