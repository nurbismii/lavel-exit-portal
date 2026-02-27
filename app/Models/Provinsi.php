<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $connection = 'vpeople';
    protected $table = 'master_provinsi';

    protected $guarded = [];

}
