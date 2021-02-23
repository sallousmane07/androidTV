<?php

namespace App\Http\Controllers;

use App\Models\Chaine;
use Dotenv\Validator;
use Illuminate\Http\Request;

class ChaineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $chaines= Chaine::all();

        return response()->json($chaines, 200);
              

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validator=$this->getValidation($request);

        if ($validator->fails()) {
            return response()->json([
                "status"=>false,
                "message"=>"Data no valid",
                'errors'=>$validator->errors()                              
            ]);
        }
        $chaine= new Chaine();

        
        $chaine->chaine_name=$request->chaine_name;    
        $chaine->logo_name=$request->logo_name;
        $chaine->slogan=$request->slogan;
        $chaine->urlVideo=$request->urlVideo;
        
        //enregistrement de la photoTV
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
