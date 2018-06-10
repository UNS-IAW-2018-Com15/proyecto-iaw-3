<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Complejo;

class AdminController extends Controller {

 public function show(){
 	$complejos = Complejo::all();
  return view('index')->with('complejos',$complejos);
}

public function add(){
 return view('add');
}

public function save(Request $request){

 $fail = $this->validarComplejo($request,false);
 if($fail != "ok")
  return redirect()->back()->with(['error' => $fail]);

$complejo = new Complejo();
$complejo->nombre = $request->nombre;
$complejo->direccion = $request->direccion;
$lat = doubleval($request->latitud);
$lon = doubleval($request->longitud);
$complejo->coordenadas = [$lat,$lon];
$complejo->telefono = $request->telefono;
$cancha['id'] = "1";
$cancha['tamanio'] = $request->size;
$cancha['material'] = $request->material;
$complejo->canchas = [$cancha];
$complejo->horarios = [$request->lunes, $request->martes, $request->miercoles,
  $request->jueves, $request->viernes, $request->sabado, $request->domingo];
  $complejo->save();
  return redirect('/complejos')->with(['success' => 'Se ha creado un nuevo complejo.']);
}

/*
*	Comprueba que los parametros recibidos del request sean correctos
*/
private function validarComplejo($request,$compararIde){

 if(empty($request->nombre))
  return "El nombre no puede ser vacio.";
  $comp = Complejo::where('nombre',$request->nombre)->get();

if($compararIde && isset($comp[0])){
      if($comp[0]->_id != $request->ide)
        return "El nombre de complejo".$request->nombre." ya existe.";
}
else if(isset($comp[0]))
    return "El nombre de complejo ".$request->nombre." ya existe.";
if(empty($request->direccion))
  return "La direccion no puede ser vacia.";
if(empty($request->latitud) || empty($request->longitud))
  return "Las coordenadas no pueden ser vacias.";
if(!is_numeric($request->latitud) || !is_numeric($request->longitud))
  return "Las coordendas deben ser numericas.";
if(empty($request->telefono))
  return "El telefono no puede ser vacio.";
if(preg_match("/[a-zA-Z]/i", $request->telefono)){
 return "El telefono no puede contener letras.";
}
if(empty($request->lunes) || empty($request->martes) || empty($request->miercoles) ||
  empty($request->jueves) || empty($request->viernes) || empty($request->sabado) ||
  empty($request->domingo))
  return "Los horarios no pueden estar vacios.";
if(!$this->horarioCorrecto($request->lunes) || !$this->horarioCorrecto($request->martes) ||
  !$this->horarioCorrecto($request->miercoles) || !$this->horarioCorrecto($request->jueves) ||
  !$this->horarioCorrecto($request->viernes) || !$this->horarioCorrecto($request->sabado) ||
  !$this->horarioCorrecto($request->domingo))
  return "Los horarios ingresados son incorrectos Deben ser (hr. apertura - hr. cierre).";
return "ok";
}

private function horarioCorrecto($hor){
 $split = explode("-",$hor,3);
 if(count($split) == 1 || count($split) == 3)
  return false;
if(!is_numeric($split[0]) || !is_numeric($split[1]))
  return false;
return true;
  	//Faltan mas chequeos... (>=0 y <=24 c/u)
}

public function delete($id){
  $comp = Complejo::where('_id',$id)->get();
  if(!isset($comp[0]))
    return response()->json(['error' => 'error'],404);
  else
    Complejo::where('_id',$id)->delete();
  return response()->json(['success' => 'success'],200);
}

public function saveCancha(Request $request){
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

public function update(Request $request){

  $fail = $this->validarComplejo($request,true);
  if($fail != "ok")
    return redirect()->back()->with(['error' => $fail]);

  $comp = Complejo::where('_id',$request->ide)->get();
  $complejo = $comp[0];
  $complejo->nombre = $request->nombre;
  $complejo->direccion = $request->direccion;
  $lat = doubleval($request->latitud);
  $lon = doubleval($request->longitud);
  $complejo->coordenadas = [$lat,$lon];
  $complejo->telefono = $request->telefono;
  $complejo->horarios = [$request->lunes, $request->martes, $request->miercoles,
    $request->jueves, $request->viernes, $request->sabado, $request->domingo];
  $complejo->save();
    return redirect('/complejos')->with(['success' => 'Se ha actualizado el complejo '.$complejo->nombre]);
  }

  public function edit($id){
      $comp = Complejo::where('_id',$id)->get();
      if(!isset($comp[0]))
          return redirect()->back()->with(['error' => 'Cancha no encontrada']);
      return view('edit')->with('complejo',$comp[0]);
  }

  public function deleteCancha(Request $request){

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

  public function deleteComentario(Request $request){

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
