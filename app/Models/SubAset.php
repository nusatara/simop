<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Spatial;


class SubAset extends Model
{
use HasFactory,Resizable,Spatial;
protected $table =  "sub_asets";
protected $spatial = ['x'];
public function jenis_asets(){
    return $this -> belongsTo('App\Models\JenisAset','id_jenisaset','id')->withDefault([
        'nama_asets' => ''
    ]);
}
public function jenis_bangunan(){
    return $this -> belongsTo('App\Models\JenisBangunan','id_jenisbangunan','id')->withDefault([
        'nama_bangunan' => ''
    ]);
}
}