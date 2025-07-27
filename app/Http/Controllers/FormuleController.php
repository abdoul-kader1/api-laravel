<?php

namespace App\Http\Controllers;

use App\Models\Formule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class FormuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $formule = Formule::all();
        return response()->json(["reponse"=>$formule],Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
             'type_formule' => 'required|string|max:255',
             'prix' => 'required|numeric',
        ]);

        $recupTypeFormule = $request->input("type_formule");
        $verifieTypeFormule = Formule::whereTypeFormule($recupTypeFormule)->first();
        if(!$verifieTypeFormule){
            $formule = Formule::create($request->all());
            return response()->json([
                "response"=>$formule
            ],Response::HTTP_OK);
        }else{
             return response()->json([
                "erreur"=>"Cette formule existe déja"
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $typeFormule)
    {
        $formule = Formule::whereTypeFormule($typeFormule)->first();
        if($formule){
            return response()->json([
                "response"=>$formule
            ],Response::HTTP_OK);
        }else{
             return response()->json([
                "erreur"=>"type de formule introuvable"
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
             'type_formule' => 'required|string|max:255',
             'prix' => 'required|numeric',
        ]);

         $formuleBdd = Formule::whereId($id)->first();
         if($formuleBdd){
            $formuleBdd->update($request->all());
            return response()->json([
                "response"=>$formuleBdd
            ],Response::HTTP_OK);
         }else{
            return response()->json([
                "erreur"=>"id formule incorrect"
            ],Response::HTTP_BAD_REQUEST);
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $formuleBdd = Formule::whereId($id)->first();
          if($formuleBdd){
            $formuleBdd->delete($id);
            return response()->json([[]],Response::HTTP_OK);
         }else{
            return response()->json([
                "erreur"=>"id formule incorrect"
            ],Response::HTTP_BAD_REQUEST);
         }
    }
}
