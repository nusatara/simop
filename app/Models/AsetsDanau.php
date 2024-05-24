<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Spatial;

class AsetsDanau extends Model
{
use HasFactory,Resizable,Spatial;
protected $table =  "asets_danau";
protected $spatial = ['x'];
}