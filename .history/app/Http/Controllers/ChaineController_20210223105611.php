<?php

namespace App\Http\Controllers;

use App\Models\Chaine;
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

        $validator=$this->getValidProduct($request);

        if ( $validator->fails()) {
            return response()->json([
                "status"=>false,
                "message"=>"Certains valeurs du formulaire ne sont pas renseigné ou sont incorrects:",
                'errors'=>$validator->errors(),
                                   
                
            ]);
        }
        $produit= new Produit();
        //image
        
        $produit->libelle=$request->libelle;    
        $produit->code=$request->code;
        $produit->rI=$request->rI;
        $produit->type=$request->type;
        $produit->qteSeuil=$request->qteSeuil;
        $produit->qteStock=$request->qteStock;
        $produit->groupe_produit_id=GroupeProduit::find($request->categorie)->id;
        $produit->unite=$request->unite;
        $produit->vendable=$this->achatable;
        $produit->achetable=$this->vendable;

        if (!$request->type) {
            $produit->type='consommable';
        }
        else
          $produit->type=$request->type;       

        $produit->qteStock=$request->qteStock;
        $produit->qteSeuil=$request->qteSeuil;
        $produit->prixVenteMin=$request->prix_vente_min;
        $produit->prixVenteMax=$request->prix_vente_max;    
        $produit->prixAchatMin=$request->prix_achat_min;
        $produit->prixAchatMax=$request->prix_achat_max;
        //enregistrement de la photo
     

        if($produit->save()){
            if($request->hasFile('photo')) {                 
                $image = $request->file('photo');        
                $ext = $image->getClientOriginalExtension();
                $filename = $produit->id.'.'.$ext;                  
                 $save = $image->move('images/produits', $filename);
                 $produit->img=$filename;
                 if($save)
                    $produit->save();               
                      //Produit::where('id',$produit->id)->update(['img',$produit->img]);
            }
            
            
            return response()->json([
                "status"=>true,
                "message"=>"Le produit a été enregistré avec succès ",
                'data'=>''
            ]);
        }
        else{
            return response()->json([
                "status"=>false,
                "message"=>"Quelque chose s'est mal passé lors de l'enregistrement. Veuillez  réessayer plus tard!",
                'data'=>''                  
                
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
