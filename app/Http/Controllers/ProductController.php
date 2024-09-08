<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Type;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all('id','name');
        $types = Type::all('id','name');
        $products = Product::all();
        return Inertia::render('Admin/Products/Create',[
            'categories' => $categories,
            'types' => $types,
            'products' => $products,
        ]);
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

        //sleep(1);
        
      /*   $fields = $request->validate([
            'catalog_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'bulk_unit_price' => ['nullable', 'numeric', 'min:0'],
            'unit_price' => ['nullable', 'numeric', 'min:0'],
            'percent_off' => ['nullable', 'numeric', 'between:0,100'],
            'offer' => ['nullable', 'boolean'], 
            'price_offer' => ['nullable', 'numeric', 'min:0'],
            'stock' => ['required', 'boolean'],
            'image_url' =>  ['nullable', 'image', 'max:300'],
            'category_id' => ['required', 'integer'],
            'type_id' => ['required', 'integer'],
       ]);   */  
       /* 
       'category_id' => ['required', 'integer', 'exists:categories,id'],
       'type_id' => ['required', 'integer', 'exists:types,id'],
       $fields['offer'] = $request->has('offer') ? $request->input('offer') : false;
       $fields['stock'] = $request->has('stock') ? $request->input('stock') : false; 
       
      
       if($request->hasFile('image')){
           $fields['image'] = Storage::disk('public')->put('images',$request->image);
       }
 */
     
        Product::create($request->all());

       // Retornar alguna respuesta, puede ser una redirección o mensaje
    
       /* return  redirect('home')->with('message', 'El registro se ha guardado exitosamente.');  */
       return redirect()->route('home')->with('message', 'El registro se ha guardado exitosamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id); // Busca el producto por su ID

        return Inertia::render('Products/Show', [
            'product' => $product,
        ]);
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
