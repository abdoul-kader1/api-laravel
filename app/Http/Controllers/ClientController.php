<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        // Optionnel: charger les relations pour éviter N+1 query problem
        // $clients = Client::with(['carte', 'abonnements.formule'])->get();
        return response()->json($clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
            'nom' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'taille' => 'nullable|integer|min:0',
        ]);

        $client = Client::create($request->all());
        return response()->json($client,Response::HTTP_CREATED);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Les données fournies sont invalides.',
                'errors' => $e->getMessage()
            ], Response::HTTP_UNPROCESSABLE_ENTITY); 
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
