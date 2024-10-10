<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $employees = User::where('rol','=','admin')->get();        
            //dd($employees);
            return Inertia::render('Admin/Employees/Index',[
                'employees' => $employees,
            ]);
        }  catch (\Exception $e) {
            return back()->withErrors('Error al obtener empleados.');
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
        sleep(1);
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:8',
            ]);
            
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'rol' => 'admin',
            ]);
            
            return redirect()->route('employees.index')->with('greet', 'El empleado se a creado exitosamente.');
        }catch (\Exception $e) {
            return back()->withErrors('Error al crear empleado.');
        }
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
        sleep(1);
        try {

            $user = User::findOrFail($id);
            dd($user);
            $fields = $request->validate([
                'name' => 'max:255',
                'email' => ['email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'password' => 'nullable|confirmed|min:8',
            ]);
            
            $data = [
                'name' => $fields['name'],
                'email' => $fields['email'],
                'rol' => 'admin',
            ];
            
            if (!empty($fields['password'])) {
                $data['password'] = bcrypt($fields['password']);
            }
    
            $user->update($data);
    
            return redirect()->route('employees.index')->with('greet', 'Los datos del empleado se han actualizado exitosamente.');
        } catch (\Exception $e) {
            return back()->withErrors('Error al actualizar los datos del empleado.');
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        sleep(1);
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('employees.index')->with('greet', 'El empleado '.$user->name.' ha sido eliminado exitosamente.');
        } catch (\Exception $e) {
            return back()->withErrors('Error al eliminar empleado.');
        }      
    }
}
