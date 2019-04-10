<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelefonosController extends Controller {

    // obtiene un listado de correos
    public function obtenerTelefonos() {
        return \App\TelefonosModel::all();
    }

    // crea un telefono
    public function crearTelefono(Request $request) {
        if( !$request->has(['idContacto', 'etiqueta', 'telefono']) ) {
            return false;
        }
        $idContacto = $request->__get('idContacto');
        $etiqueta = $request->__get('etiqueta');
        $telefono = $request->__get('telefono');
        $idTelefono = \App\TelefonosModel::insertGetId(['ID_CONTACTO' => $idContacto, 'ETIQUETA' => $etiqueta, 'TELEFONO' => $telefono]);
        return \DB::select('SELECT * FROM TELEFONOS WHERE ID = ' . $idTelefono . ' AND ID_CONTACTO = ' . $idContacto );
    }

    // edita un telefono
    public function editarTelefono(Request $request) {
        if( !$request->has(['idContacto', 'idTelefono']) ) {
            return false;
        }
        $params = array();
        if( $request->has('etiqueta') ) {
            $params['ETIQUETA'] = $request->__get('etiqueta');
        }
        if( $request->has('telefono') ) {
            $params['TELEFONO'] = $request->__get('telefono');
        }
        \DB::table('TELEFONOS')->where(['ID' => $request->__get('idTelefono'), 'ID_CONTACTO' => $request->__get('idContacto')])->update($params);
        return \DB::select('SELECT * FROM TELEFONOS WHERE ID = ' . $request->__get('idTelefono') . ' AND ID_CONTACTO = ' . $request->__get('idContacto') );
    }

    // borra un telefono
    public function borrarTelefono(int $idTelefono, int $idContacto) {
        \App\TelefonosModel::destroy(['ID' => $idTelefono, 'ID_CONTACTO' => $idContacto]);
        return ['ID' => $idTelefono, 'ID_CONTACTO' => $idContacto];
    }

}