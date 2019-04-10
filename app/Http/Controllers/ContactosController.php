<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactosController extends Controller {

    // obtiene una lista de los contactos
    public function obtenerContactos() {
        $contactosArray = \App\ContactosModel::all();
        foreach( $contactosArray as $contacto ) {
            $contacto['CORREOS'] = \DB::select('SELECT CO.* FROM CONTACTO C LEFT JOIN CORREOS CO ON CO.ID_CONTACTO = C.ID WHERE C.ID = ' . $contacto->ID);
            $contacto['TELEFONOS'] = \DB::select('SELECT T.* FROM CONTACTO C LEFT JOIN TELEFONOS T ON T.ID_CONTACTO = C.ID WHERE C.ID = ' . $contacto->ID);
            if($contacto['TELEFONOS'][0]->ID == null) {
                $contacto['TELEFONOS'] = null;
            }
            if($contacto['CORREOS'][0]->ID == null) {
                $contacto['CORREOS'] = null;
            } 
        }
        return  $contactosArray;
    }

    // crea un contacto nuevo
    public function crearContacto(Request $request) {
        if( ! $request->has(['nombre', 'apellidoPaterno', 'apellidoMaterno', 'fechaNacimiento', 'alias']) ) {
            return false;
        }
        $nombre = $request->__get('nombre');
        $apellidoPaterno = $request->__get('apellidoPaterno');
        $apellidoMaterno = $request->__get('apellidoMaterno');
        $alias = $request->__get('alias');
        $fechaNacimiento = date("Y-m-d", strtotime($request->__get('fechaNacimiento')));
        $fechaCreacion = date("Y-m-d");
        $id = \App\ContactosModel::insertGetId(['NOMBRE' => $nombre, 'APELLIDO_PATERNO' => $apellidoPaterno, 'APELLIDO_MATERNO' => $apellidoMaterno, 'FECHA_NACIMIENTO' => $fechaNacimiento, 'ALIAS' => $alias, 'FECHA_CREACION' => $fechaCreacion]);
        return \DB::select('SELECT * FROM CONTACTO WHERE ID = ' . $id);
    }

    // crea un contacto nuevo con telefonos y correos
    public function crearContactoFull(Request $request) {
        if( ! $request->has(['nombre', 'apellidoPaterno', 'apellidoMaterno', 'fechaNacimiento', 'alias', 'telefonos', 'correos']) ) {
            return false;
        }

        $nombre = $request->__get('nombre');
        $apellidoPaterno = $request->__get('apellidoPaterno');
        $apellidoMaterno = $request->__get('apellidoMaterno');
        $alias = $request->__get('alias');
        $fechaNacimiento = date("Y-m-d", strtotime($request->__get('fechaNacimiento')));
        $fechaCreacion = date("Y-m-d");
        $telefonos = $request->__get('telefonos');
        $correos = $request->__get('correos');

        $idContacto = \App\ContactosModel::insertGetId(['NOMBRE' => $nombre, 'APELLIDO_PATERNO' => $apellidoPaterno, 'APELLIDO_MATERNO' => $apellidoMaterno, 'FECHA_NACIMIENTO' => $fechaNacimiento, 'ALIAS' => $alias, 'FECHA_CREACION' => $fechaCreacion]);

        for($i = 0; $i < count($telefonos); $i++) {
            \App\TelefonosModel::insertGetId(['ID_CONTACTO' => $idContacto, 'ETIQUETA' => $telefonos[$i]['ETIQUETA'], 'TELEFONO' => $telefonos[$i]['TELEFONO'] ]);
        }
        for($i = 0; $i < count($correos); $i++) {
            \App\CorreosModel::insertGetId(['ID_CONTACTO' => $idContacto, 'CORREO' => $correos[$i]['CORREO'] ]);
        }
        return \DB::select('SELECT * FROM CONTACTO WHERE ID = ' . $idContacto);
    }

    // edita un contacto
    public function editarContacto(Request $request) {
        $params = array();
        if( !$request->has('id') ) {
            return 0;
        }
        if ( $request->has('nombre') ) {
            $params['NOMBRE'] = $request->__get('nombre');
        }
        if ( $request->has('apellidoPaterno') ) {
            $params['APELLIDO_PATERNO'] = $request->__get('apellidoPaterno');
        }
        if ( $request->has('apellidoMaterno') ) {
            $params['APELLIDO_MATERNO'] = $request->__get('apellidoMaterno');
        }
        if ( $request->has('fechaNacimiento') ) {
            $params['FECHA_NACIMIENTO'] = $request->__get('fechaNacimiento');
        }
        if ( $request->has('alias') ) {
            $params['ALIAS'] = $request->__get('alias');
        }
        if( count($params) > 0 ) {
            \DB::table('CONTACTO')->where('ID', $request->__get('id'))->update($params);
        }

        if ( $request->has('imagen') ) {
            $file = $request->file('imagen');
            $path = $file->store('contactos', ['disk' => 'public']);
            \DB::select('UPDATE CONTACTO SET IMAGEN = "' . $path . '"  WHERE ID = ' . $request->__get('id'));
        }
        return \DB::select('SELECT * FROM CONTACTO WHERE ID = ' . $request->__get('id'));
    }

    // borra un contacto
    public function borrarContacto(int $idContacto) {
        \DB::select('DELETE FROM CORREOS WHERE ID_CONTACTO = ' . $idContacto);
        \DB::select('DELETE FROM TELEFONOS WHERE ID_CONTACTO = ' . $idContacto);
        \App\ContactosModel::destroy(['ID' => $idContacto]);
        return ['ID' => $idContacto];
    }
}