<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use inertia\Inertia;
use App\Models\Product;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
        
            $cart = session()->get('cart', []);
            //return inertia('Cart/Index', compact('cart'));
            return Inertia::render('Cart/Index', [
                'cart' => $cart, 
            ]);

        } catch (\Exception $e) {
            return back()->withErrors('Error al mostrar el carrito.');
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
        try {     
            $product = Product::find($request->id);
            
            $cart = session()->get('cart', []);
            
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity']++;
            } else {
                $cart[$product->id] = [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->unit_price ?? $product->regular_price,
                    "image" => $product->image_url
                ];
            }
            //dd($cart);

            session()->put('cart', $cart);
   
            
            return redirect()->route('home.index')->with('greet', 'El registro se agrego al carrito.');
        } catch (\Exception $e) {
            return back()->withErrors('Error al crear carrito.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    
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
    public function destroy(Request $request)
    {
        //dd($request->id);
        try {
            $cart = session()->get('cart', []);
            //dd($cart);
            if (isset($cart[$request->id])) {
                //dd($cart[$request->id]);
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            //dd($cart);
            return redirect()->route('cart.index')->with('greet', 'El registro se agrego al carrito.');
        } catch (\Exception $e) {
            return back()->withErrors('Error al eliminar del carrito.');
        }
    }
}
