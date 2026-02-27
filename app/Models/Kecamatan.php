<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $connection = 'vpeople';
    protected $table = 'master_kecamatan';

    protected $guarded = [];

}
