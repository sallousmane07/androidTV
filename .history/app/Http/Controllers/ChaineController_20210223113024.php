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
        
        //enregistrement de la photo
     

        if($chaine->save()){
            if($request->hasFile('iamge')) {                 
                $image = $request->file('image');        
                $ext = $image->getClientOriginalExtension();
                $filename = $chaine->id.'.'.$ext;                  
                 $save = $image->move('images/chaines', $filename);
                 $chaine->image=$filename;
                 if($save)
                    $chaine->save();               
                      //chaine::where('id',$chaine->id)->update(['img',$chaine->img]);
            }
            
            
            return response()->json([
                "status"=>true,
                "message"=>"",
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
    public function getValidation($request){
        $this->validator = Validator::make($request->all(), [
            'chaine_name' => 'required|unique:chaines',
            'logo_name' => 'unique:chaines',
            'urlVideo' => 'required|unique:chaines|max:1000',
            'categorie' =>  'required|max:500'           
        ]);
      
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
