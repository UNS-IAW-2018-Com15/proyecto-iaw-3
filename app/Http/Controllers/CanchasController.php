<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Complejo;

class CanchasController extends Controller {

public function __construct(){
        $this->middleware('auth');
    }


public function save(Request $request){
  $id = $request->id;
  $comp = Complejo::where('_id',$id)->get();
  if(!isset($comp[0]) )
    return response()->json(['error' => 'error'],404);
  $cancha['id'] = "1";    //DEPRECATED
  $cancha['tamanio'] = $request->tamanio;
  $cancha['material'] = $request->material;
  $comp[0]->canchas = array_merge($comp[0]->canchas, [$cancha]);
  $comp[0]->save();
  return response()->json(['success' => 'success'],200);
}

  public function delete(Request $request){

    $comp = Complejo::where('_id',$request->id)->get();
    if(!isset($comp[0]))
      return response()->json(['error' => 'error> no existe el complejo '.$request->id],404);
    $complejo =  $comp[0];
    $cancha['id'] = "1";    //DEPRECATED
    $cancha['tamanio'] = $request->tamanio;
    $cancha['material'] = $request->material;
    $canchas=$complejo->canchas;
    $i = 0;
    $nuevos = array();
    foreach ($canchas as $value) {
        if($value['tamanio'] != $request->tamanio && $value['material'] != $request->material)
             $nuevos[$i++]=$value;
    }
    $complejo->canchas = $nuevos;
    $complejo->save();
    return response()->json(['success' => 'success'],200);
  }

}
