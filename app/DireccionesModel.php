<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DireccionesModel extends Model {
    protected $table = 'DIRECCIONES';
    protected $primaryKey = 'ID';
    public $incrementing = false;
    public $timestamps = false;
}
