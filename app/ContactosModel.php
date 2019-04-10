<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Modelo de contactos
class ContactosModel extends Model {
    protected $table = 'CONTACTO';
    protected $primaryKey = 'ID';
    public $incrementing = false;
    public $timestamps = false;
}
