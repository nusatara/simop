<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Spatial;


class AsetsEmbung extends Model
{
use HasFactory,Resizable,Spatial;
protected $table =  "asets_embung";
protected $spatial = ['x'];
}