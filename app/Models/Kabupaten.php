<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $connection = 'vpeople';
    protected $table = 'master_kabupaten';

    protected $guarded = [];

}
