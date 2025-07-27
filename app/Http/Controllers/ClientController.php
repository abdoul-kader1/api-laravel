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
        return response()->json(["reponse"=>$clients],Response::HTTP_OK);
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

        $nom = $request->input("nom");

        $clientBdd = Client::whereNom($nom)->first();

        if(!$clientBdd){
            $client = Client::create($request->all());
            return response()->json(
                ['reponse'=>$client],
                Response::HTTP_CREATED
            );
        }else{
            return response()->json(["erreur"=>"Un client a déjà ce nom"],Response::HTTP_BAD_REQUEST);
        }
        }catch(Exception $e){
            return response()->json([
                'erreur' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST); 
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $clientBdd = Client::whereId($id)->first();
        if($clientBdd){
            return response()->json([
                "reponse"=>$clientBdd
            ],Response::HTTP_OK);
        }else{
             return response()->json([
                "erreur"=>"id du client incorrect"
            ],Response::HTTP_BAD_REQUEST);
        }
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $clientBdd = Client::whereId($id)->first();
        if($clientBdd){

             $champValider = $request->validate([
            'age' => 'required|integer|min:0',
            'taille' => 'nullable|integer|min:0',
        ]);
        
         $clientBdd->update([
            "age"=>$champValider['age'],
            "taille"=>$champValider['taille']
        ]);

        return response()->json([
            "reponse"=>$clientBdd,
        ],Response::HTTP_OK);

        }else{
             return response()->json([
                "erreur"=>"id du client incorrect"
            ],Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $clientBdd = Client::whereId($id)->first();
        if($clientBdd){
            $clientBdd->delete($id);
             return response()->json(null,Response::HTTP_OK);
        }else{
            return response()->json([
                "erreur"=>"id du client incorrect"
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}
