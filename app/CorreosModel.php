<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// modelo de correos
class CorreosModel extends Model {
    protected $table = 'CORREOS';
    protected $primaryKey = 'ID';
    public $incrementing = false;
    public $timestamps = false;
}
