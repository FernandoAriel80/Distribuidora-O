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
            //dd( $product);
            //dd($user->id);
            //dd($request->type,$product->id);
           
            $cart = session()->get('cart', []);
            //dd($cart );
            if (isset($cart[$product->id])) {
                dd($cart,'if');
                $cart[$product->id]['quantity']++;
                $cartTable = Cart::findOrFail($cart[$product->id]['cart_id']);
                $cartTable->items()->update([
                    "quantity" => $cart[$product->id]['quantity'],
                ]);
            } else {
                dd($cart[41]['cart_id']);
                //$cartTable = Cart::findOrFail($cart[$product->id]['cart_id']);
               /*   if (isset($cart[$product->id])) {
                   
                } else {
                    # code...
                }  */
                $cartTable = Cart::create([
                    'user_id' => $user->id
                ]);
                //dd($cartTable->id);
                //dd($product->id,$product->catalog_id,$cartTable->id);
                $cartTable->items()->create([
                    "cart_id" => $cartTable->id,
                    "product_id" => $product->id,
                    "quantity" => 1,
                    "price" => $request->type == 'unit' ? $product->unit_price : $product->bulk_unit_price,
                ]);
                $cart[$product->id] = [
                    "cart_id" => $cartTable->id,
                    "catalog_id" => $product->catalog_id,
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $request->type == 'unit' ? $product->unit_price : $product->bulk_unit_price,
                    "image" => $product->image_url
                ];
                /*  $result=$cartTable->items()->create([
                    "catalog_id" => $product->catalog_id,
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $request->type == 'unit' ? $product->unit_price : $product->bulk_unit_price,
                    "url_image" => $product->url_image,
                    "cart_id" => $cartTable->id
                ]); */
              
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

          /*       $product = Product::findOrFail($request->id);
                dd($product);
                $product->delete(); */
            }
           
            return back()->with('greet', 'El registro se agrego al carrito.');
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
