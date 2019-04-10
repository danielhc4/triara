<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CorreosController extends Controller {

    // obtiene una lista de correos
    public function obtenerCorreos() {
        return \App\CorreosModel::all();
    }

    // crea un correo
    public function crearCorreo(Request $request) {
        if( !$request->has(['idContacto', 'correo']) ) {
            return false;
        }
        $idContacto = $request->__get('idContacto');
        $correo = $request->__get('correo');
        $idCorreo = \App\CorreosModel::insertGetId(['ID_CONTACTO' => $idContacto, 'CORREO' => $correo]);
        return \DB::select('SELECT * FROM CORREOS WHERE ID = ' . $idCorreo . ' AND ID_CONTACTO = ' . $idContacto );
    }

    // edita un correo
    public function editarCorreo(Request $request) {
        if( !$request->has(['idContacto', 'idCorreo']) ) {
            return false;
        }
        $params = array();
        if( $request->has('correo') ) {
            $params['CORREO'] = $request->__get('correo');
        }
        \DB::table('CORREOS')->where(['ID' => $request->__get('idCorreo'), 'ID_CONTACTO' => $request->__get('idContacto')])->update($params);
        return \DB::select('SELECT * FROM CORREOS WHERE ID = ' . $request->__get('idCorreo') . ' AND ID_CONTACTO = ' . $request->__get('idContacto') );
    }

    // borra un correo
    public function borrarCorreo(int $idCorreo, int $idContacto) {
        \App\CorreosModel::destroy(['ID' => $idCorreo, 'ID_CONTACTO' => $idContacto]);
        return ['ID' => $idCorreo, 'ID_CONTACTO' => $idContacto];
    }
}
