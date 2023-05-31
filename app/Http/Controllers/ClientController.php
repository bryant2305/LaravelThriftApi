<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clients = Client::all();
        return response()->json($clients);
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
        $request ->validate([
            "nombre"=>"required"

        ]);
        $client = new Client();
        $client -> nombre = $request->nombre;
        $client -> adress = $request->adress;
        $client -> phone = $request->phone;
        $client -> email = $request->email;
        $client -> save();
        $data=[
            "message"=>"todo correcto dale",
            "client"=> $client
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return response()->json($client);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {

        $client -> nombre = $request->nombre;
        $client -> adress = $request->adress;
        $client -> phone = $request->phone;
        $client -> email = $request->email;
        $client -> save();
        $data=[
            "message"=>"update correctamente dale",
            "client"=> $client
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        $data=[
            "message"=>"Deleted correctamente dale",
            "client"=> $client
        ];

        return response()->json($data);
    }

    public function attach(Request $request)
    {

        $client = Client::find($request->client_id);
        $client->services()->attach($request->service_id);


        $data=[
            "message"=>"proceso completado correctamente",
            "client"=> $client
        ];

        return response()->json($data);
    }
}
