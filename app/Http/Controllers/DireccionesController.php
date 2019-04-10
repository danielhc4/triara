<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DireccionesController extends Controller {

    // obtiene una lista de direcciones
    public function obtenerDirecciones() {
        return \App\DireccionesModel::all();
    }

    // crea un direcciones
    public function crearDireccion(Request $request) {
        if( !$request->has(['idContacto', 'direccion']) ) {
            return false;
        }
        $idContacto = $request->__get('idContacto');
        $direccion = $request->__get('direccion');
        $idCorreo = \App\DireccionesModel::insertGetId(['ID_CONTACTO' => $idContacto, 'DIRECCION' => $direccion]);
        return \DB::select('SELECT * FROM DIRECCIONES WHERE ID = ' . $idCorreo . ' AND ID_CONTACTO = ' . $idContacto );
    }

    // edita un direccion
    public function editarDireccion(Request $request) {
        if( !$request->has(['idContacto', 'idDireccion']) ) {
            return false;
        }
        $params = array();
        if( $request->has('direccion') ) {
            $params['DIRECCION'] = $request->__get('direccion');
        }
        \DB::table('CORREOS')->where(['ID' => $request->__get('idCorreo'), 'ID_CONTACTO' => $request->__get('idContacto')])->update($params);
        return \DB::select('SELECT * FROM DIRECCIONES WHERE ID = ' . $request->__get('idCorreo') . ' AND ID_CONTACTO = ' . $request->__get('idContacto') );
    }

    // borra un direccion
    public function borrarDireccion(int $idCorreo, int $idContacto) {
        \App\DireccionesModel::destroy(['ID' => $idCorreo, 'ID_CONTACTO' => $idContacto]);
        return ['ID' => $idCorreo, 'ID_CONTACTO' => $idContacto];
    }
}
