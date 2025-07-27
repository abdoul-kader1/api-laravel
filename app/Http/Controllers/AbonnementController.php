<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use App\Models\Client;
use App\Models\Formule;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AbonnementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
             'client_id' => 'required|integer',
             'formule_id' => 'required|integer',
        ]);

        $client = Client::whereId($request->input("client_id"))->first(); 
        $formule = Formule::whereId($request->input("formule_id"))->first();
        try{
            if($client){
            if($formule){
                  $dateDebut = Carbon::now();
                  $dateFin = $dateDebut->copy()->addMonths(1);
                  $abonnement = Abonnement::create([
                    "client_id"=>$client->id,
                    "formule_id"=>$formule->id,
                    "date_debut"=>$dateDebut,
                    "date_fin"=>$dateFin,
                    "actif"=>true
                  ]);

                 return response()->json([
                "response"=>$abonnement->load(["client"])
            ],Response::HTTP_OK);
            }else{
                return response()->json([
                "erreur"=>"id formule incorrect"
            ],Response::HTTP_BAD_REQUEST);
            }
        }else{
             return response()->json([
                "erreur"=>"id client incorrect"
            ],Response::HTTP_BAD_REQUEST);
        }
        }catch(Exception $e){
            return response()->json([
                "erreur"=>$e
            ],Response::HTTP_BAD_REQUEST);
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
