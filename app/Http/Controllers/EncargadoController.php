<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encargado;
use App\Http\Resources\EncargadoResource;
use App\Exceptions\SomethingWentWrong;

class EncargadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{

            $encargado = Encargado::all();
            return  response()->json($encargado);

        }
        catch(\Throwable $th){
            throw new SomethingWentWrong($th);
           }
           return new EncargadoResource($encargado);
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
        $request->validate([
            "nombre" => "required",
            "apellido"=>'required',
            "cliente_id"=>"required"
        ]);

        try{

            $encargado = new Encargado();
            $encargado->nombre = $request->nombre;
            $encargado -> apellido = $request->apellido;
            $encargado->cliente_id = $request->cliente_id;
            $encargado->save();

            $data = [
                "message" => "encargado created successfully",
                "client" => $encargado
            ];
            return new EncargadoResource($encargado);
        }catch(\Throwable $th){

            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        try {
            $encargado = Encargado::find($id);

        if ($encargado == null){
             return response()->json("error , no se encontro ningun servicio");
        }
            return new EncargadoResource($encargado);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }

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
