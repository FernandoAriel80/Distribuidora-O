<?php

namespace App\Http\Controllers;

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
        ]);
    
        $search = (string) $request->input('search', '');

        try {
            $products = Product::with(['type', 'category'])
            ->search($search)
            ->orderBy('id', 'desc')
            ->get();
            //dd($products);
            return Inertia::render('Home', [
                'products' => $products,
                'searchTerm' => $search,
                
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
