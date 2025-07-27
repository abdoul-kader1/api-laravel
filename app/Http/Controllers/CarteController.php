<?php

namespace App\Http\Controllers;

use App\Models\Carte;
use App\Models\Client;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carte = Carte::with('client')->get();
        return response()->json([
                "response"=>$carte
            ],Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,String $id)
    {
        $clientBdd = Client::whereId($id)->first();
        if($clientBdd){
           try{
             $request->validate([
                "nom"=>'required|string|max:255',
                "actif"=>'required|boolean'
            ]);
            $carte = $clientBdd->carte()->create($request->all());
            return response()->json([
                "response"=>$carte->load('client')
            ],Response::HTTP_OK);
           }catch(Exception $e){
            return response()->json([
                "erreur"=>$e
            ],Response::HTTP_BAD_REQUEST);
           }
        }else{
            return response()->json([
                "erreur"=>"id client incorrect"
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $idClient)
    {
         $carte = Carte::whereClientId($idClient)->get();
         return response()->json([
                "response"=>$carte
            ],Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idCarte,string $idClient)
    {
        $carte = Carte::whereId($idCarte)->whereClientId($idClient)->first();
        if($carte){
            $request->validate([
                "actif"=>'required|boolean'
            ]);

            $carte->update($request->all());
            return response()->json([
                "response"=>$carte->load("client")
            ],Response::HTTP_OK);
        }else{
             return response()->json([
                "erreur"=>"id carte ou id client incorrect"
            ],Response::HTTP_BAD_REQUEST);
        }
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
