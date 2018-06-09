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

  	$fail = $this->validarComplejo($request);
  	if($fail != "ok")
  		return redirect()->back()->with(['error' => $fail]);

  	$complejo = new Complejo();
  	$complejo->nombre = $request->nombre;
  	$complejo->direccion = $request->direccion;
  	//$coord = new \stdClass();
  	//$coord->latitud = $request->latitud;
  	//$coord->longitud = $request->longitud;
    //$complejo->coordenadas = json_encode($coord);
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
  private function validarComplejo($request){

  	if(empty($request->nombre))
  		return "El nombre no puede ser vacio.";
  	$comp = Complejo::where('nombre',$request->nombre)->get();
  	if(isset($comp[0]))
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
  $comp = Complejo::where('id',$id)->get();
  if(!isset($comp[0]))
      return response()->json(['error' => 'error'],401);
  else
      Complejo::where('id',$id)->delete();
  return response()->json(['success' => 'success'],200);
}
}
