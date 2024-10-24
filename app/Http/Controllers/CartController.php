<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use inertia\Inertia;
use App\Models\Product;
use App\Models\Cart;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
        
            $cart = session()->get('cart', []);
        /*     $cartTable = Cart::all();
            dd($cartTable);
            
            foreach ($cartTable->items() as $dato) {
                $cart[$dato->cart_id] = [
                    "catalog_id" => $dato->catalog_id,
                    "name" => $dato->name,
                    "quantity" => $dato->cuantity,
                    "price" => $dato->price,
                    "image" => $dato->image_url
                ];
            }
            */
            session()->put('cart', $cart);

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
            $user = Auth::user();
            $cart = session()->get('cart', []);
            $current_cart_id = $product->id.$request->type;

            if (isset($cart[$current_cart_id])) {
                $cart[$current_cart_id]['quantity']++;
                $cartTable = Cart::findOrFail($cart[$current_cart_id]['cart_id']);
                $cartTable->update([
                    'quantity' => $cart[$current_cart_id]['quantity'],
                ]);
            } else {

                $cartTable = Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'catalog_id' => $product->catalog_id,
                    'quantity' => 1,
                    'type' => $request->type,
                ]);

                $cart[$product->id.$request->type] = [
                    'cart_id' => $cartTable->id,
                    'catalog_id' => $product->catalog_id,
                    'name' => $product->name,
                    'quantity' => 1,
                    'price' => $request->type == 'unit' ? $product->unit_price : $product->bulk_unit_price,
                    'image' => $product->image_url,
                    'type' => $request->type,
                    'bulk_unit' => $product->bulk_unit,
                    'stock' => $product->stock,
                ];
            }

            session()->put('cart', $cart);

            return back()->with('greet', 'El registro se agregó al carrito.');
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

        try {
            $cart = session()->get('cart', []);
            if (isset($cart[$request->id])) {
            /*     $cartItem = Cart::where('catalog_id','=',$cart[$request->id]['catalog_id'])
                ->where( 'user_id', '=', $cart[$request->id]['user_id'] )
                ->firstOrFail();
                dd($cartItem);
                 $cartItem ->delete();  */
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
           
            return back()->with('greet', 'El producto se elimino del carrito.');
        } catch (\Exception $e) {
            return back()->withErrors('Error al eliminar del carrito.');
        }
    }

    public function clearCart(Request $request)
    {
        $request->session()->forget('cart');
        return back()->with('success', 'Carrito limpiado.');
    }
}
