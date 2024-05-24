<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Spatial;


class JenisBangunan extends Model
{
use HasFactory,Resizable,Spatial;
protected $table =  "jenis_bangunan";
protected $spatial = ['x'];
public function jenis_asets(){
    return $this -> belongsTo('App\Models\JenisAset','id_jenisaset','id')->withDefault([
        'nama_asets' => ''
    ]);
}
}