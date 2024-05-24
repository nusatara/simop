<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Spatial;


class Desa extends Model
{
use HasFactory,Resizable,Spatial;
protected $table =  "desa";
protected $spatial = ['x'];

public function kota(){
    return $this -> belongsTo('App\Models\Kota','id_kota','id')->withDefault([
        'name' => ''
    ]);
}
public function kecamatan(){
    return $this -> belongsTo('App\Models\Kecamatan','id_kecamatan','id')->withDefault([
        'name' => ''
    ]);
}
}