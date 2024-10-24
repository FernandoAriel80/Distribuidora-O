<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use inertia\Inertia;
use App\Models\Product;
use App\Models\Cart;

use function PHPUnit\Framework\isEmpty;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
        
            $cart = session()->get('cart', []);
    
            $cartTable = Cart::with([ 'product'])->get();
            foreach ($cartTable as $dato) {
                $cart[$dato->product->id.$dato->type] = [
                    'cart_id' => $dato->id,
                    'catalog_id' => $dato->product->catalog_id,
                    'name' => $dato->product->name,
                    'quantity' => $dato->quantity,
                    'price' => $dato->type == 'unit' ? $dato->product->unit_price : $dato->product->bulk_unit_price,
                    'image' => $dato->product->image_url,
                    'type' => $dato->type,
                    'bulk_unit' => $dato->product->bulk_unit,
                    'stock' => $dato->product->stock,
                ];
            }     
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
    public function update(Request $request)
    {
        try {
            $cart = session()->get('cart', []);

            if (isset($cart[$request->id])) {
                $current_quantity = $request->data < 1? 1 : $request->data;
                $cart[$request->id]['quantity'] = $current_quantity;

                $cartTable = Cart::findOrFail($cart[$request->id]['cart_id']);
                $cartTable->update([
                    'quantity' => $current_quantity,
                ]);
            }

            return back()->with('greet', 'El registro se actualizar.');
        } catch (\Exception $e) {
            return back()->withErrors('Error al actualizar cantidad.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        try {
            $cart = session()->get('cart', []);
             
            if (isset($cart[$request->id])) {
                $cartItem = Cart::findOrFail($cart[$request->id]['cart_id']);
                
                if ($cartItem) {
                    unset($cart[$request->id]);
                    session()->put('cart', $cart);
                    $cartItem->delete();         
                }
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
