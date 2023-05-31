<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $service = Service::all();
        return response()->json($service);
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
        $service = new Service();
        $service -> name = $request->name;
        $service -> descripcion = $request->descripcion;
        $service -> price = $request->price;
        $service -> save();
        $data=[
            "message"=>"todo correcto dale",
            "client"=> $service
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
        return response()->json($service);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        //
        $service -> name = $request->name;
        $service -> descripcion = $request->descripcion;
        $service -> price = $request->price;
        $service -> save();
        $data=[
            "message"=>"update correctamente dale",
            "client"=> $service
        ];

        return response()->json($data);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
        $service->delete();
        $data=[
            "message"=>"Deleted correctamente dale",
            "client"=> $service
        ];

        return response()->json($data);
    }

    }


