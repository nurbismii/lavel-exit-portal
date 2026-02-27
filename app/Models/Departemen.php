<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    protected $connection = 'vpeople';
    protected $table = 'departemens';

    protected $guarded = [];

}
