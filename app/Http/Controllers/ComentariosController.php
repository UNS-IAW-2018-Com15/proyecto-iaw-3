<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Complejo;

class ComentariosController extends Controller {

public function __construct(){
        $this->middleware('auth');
    }

 

  public function delete(Request $request){

    $comp = Complejo::where('_id',$request->idComplejo)->get();
    if(!isset($comp[0]))
      return response()->json(['error' => 'error> no existe el complejo'.$request->id],404);
    $complejo =  $comp[0];
    $comentarios=$complejo->comentarios;
    $i = 0;
    $nuevos = array();
    foreach ($comentarios as $value) {
        if($value['_id'] != $request->idComentario)
             $nuevos[$i++]=$value;
    }
    $complejo->comentarios = $nuevos;
    $complejo->save();
    return response()->json(['success' => 'success'],200);
  }
}
