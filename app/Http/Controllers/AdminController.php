<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Type;
use App\Models\Category;
use inertia\Inertia;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['type','category'])
            ->orderBy('id','desc')
            ->paginate(5);
           // dd($products->toArray());
          return Inertia::render('Admin/Products/Index', [
            'products' => $products,
        ]); 

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all('id','name');
        $types = Type::all('id','name');
        return Inertia::render('Admin/Products/Create', [
            'categories' => $categories,
            'types' => $types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        sleep(1);
        $fields = $request->validate([
           'catalog_id' => 'required|integer',
           'name' => 'required|string|max:255',
           'description' => 'nullable|string',
           'bulk_unit_price' => 'nullable|numeric|min:0',
           'unit_price' => 'nullable|numeric|min:0',
           'percent_off' => 'nullable|numeric|between:0,100',
           'offer' => 'nullable|boolean', 
           'price_offer' => 'nullable|numeric|min:0',
           'stock' => 'required|boolean',
           'image_url' =>  'nullable|image|mimes:jpeg,png,jpg|max:2048',
           'category_id' => 'required|integer',
           'type_id' => 'required|integer',
      ]);    
      
      $fields['offer'] = $request->has('offer') ? $request->input('offer') : false;
      $fields['stock'] = $request->has('stock') ? $request->input('stock') : false; 
      
       try {
           if($request->hasFile('image_url')){
               $filename = time() . '_' . $request->file('image_url')->getClientOriginalName();
               $fields['image_url'] = Storage::disk('public')->putFileAs('image_url', $request->file('image_url'), $filename);     
           }else {
               $fields['image_url'] = '/image_url/default.jpeg';
           }
       } catch (\Exception $e) {
           return back()->withErrors('Error al subir la imagen.');
       }
     
       Product::create($fields);

       return redirect()->route('products.index')->with('greet', 'El registro se ha guardado exitosamente.');

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
