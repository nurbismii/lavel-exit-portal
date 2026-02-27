<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $connection = 'vpeople';
    protected $table = 'master_kelurahan';

    protected $guarded = [];

}
