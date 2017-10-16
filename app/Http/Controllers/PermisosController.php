<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class PermisosController extends Controller
{
    private $path = 'admin.permisos.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permisos = Permission::paginate(10);
        return view($this->path.'index', compact('permisos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->path.'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            Permission::create([
                'name'=> $request->nombre,
            ]);
            return back()->with('success','Agregado exitosamente');
        }catch(\Exception $e ){
            return back()->with('error', "Error interno al eliminar codigo: ".$e->getcode());
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$user = User::find(3);
        //$user->revokePermissionTo('post_create'); quita permisoa a roles y usuarios
        //$user->can('ejemplo') si tiene el permiso
        //$user->givePermissionTo('ejemplo'); dar permisos a usuarios 
        //$user->assignRole('post_create'); asignar role a usuario
        //$user->removeRole('escritor'); remover rol por usuario
        //$rol = Role::find(1); buscamos el rol
        //$rol->givePermissionTo('ejemplo 2') damos permisos a rol
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $permiso = Permission::findOrFail($id);
            $permiso->delete();
            return back()->with('success', "Eliminado correctamente");
        } catch (\Exception $e) {
            return back()->with('error', "Error interno al eliminar codigo: ".$e->getcode());
        }
    }
}
