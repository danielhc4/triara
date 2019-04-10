<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// modelo de teléfonos
class TelefonosModel extends Model {
    protected $table = 'TELEFONOS';
    protected $primaryKey = 'ID';
    public $incrementing = false;
    public $timestamps = false;
}
