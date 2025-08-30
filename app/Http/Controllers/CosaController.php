<?php

namespace App\Http\Controllers;

use App\Models\Cosa;
use Illuminate\Http\Request;

class CosaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $response = Http::get('https://pokeapi.co/api/v2/pokemon/pikachu');
        $pokemon = $response->json();

        // return response()->json([
        //     "hola" => "qué tal"
        // ],200,[],JSON_PRETTY_PRINT);

        $listaCosas=Cosa::all();

        return response()->json([
            "data" => $pokemon
        ], 200, [], JSON_PRETTY_PRINT);
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


        $datosValidados = $request->validate([
            "objeto" => 'required|string',
            'edad' => 'required|integer',
            'name' => "string"
        ]);

        if($datosValidados){
            $nuevaCosa = Cosa::create($datosValidados);
            return response()->json([
                "data" => $nuevaCosa
            ]);
        }else{
            echo "nada";
        }

       
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //

        $encontrado = Cosa::find($id);

        if($encontrado){

            return response()->json([
                "status" => "encontrado",
                "code" => 200,
                "data" => $encontrado
            ],200, [],JSON_PRETTY_PRINT);
        } else{
            echo "pringado";
        }


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cosa $cosa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

    $datosValidados = $request->validate([
            "objeto" => 'required|string',
            'edad' => 'required|integer',
            'name' => "string"
        ]);

        $encontrado = Cosa::find($id);

        if($encontrado){
            $encontrado->update($datosValidados);
            return response()->json([
                "status" => "modificado ". $id,
                "code" => 200,
                "data" => $encontrado
            ], 200, [], JSON_PRETTY_PRINT);
        } else{
            return response()->json([
                "status" => "elemento no encontrado",

            ], 400, [], JSON_PRETTY_PRINT);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        $encontrado = Cosa::find($id);

    if($encontrado){
            $encontrado->delete();
            return response()->json([
                "status" => "objeto eliminado"
            ],200, [], JSON_PRETTY_PRINT);
    }else{
        echo "no existe ese objeto";
    }
    }
}
