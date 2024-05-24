<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Spatial;


class Kegiatan extends Model
{
use HasFactory,Resizable,Spatial;
protected $table =  "kegiatan";
protected $spatial = ['x'];

public function asets_irigasi(){
    return $this -> belongsTo('App\Models\AsetsIrigasi','id_irigasi','id')->withDefault([
        'nama_di' => ''
    ]);
}
public function asets_bendungan(){
    return $this -> belongsTo('App\Models\AsetsBendungan','id_aset','id')->withDefault([
        'nama_bendungan' => ''
    ]);
}
public function asets_danau(){
    return $this -> belongsTo('App\Models\AsetsDanau','id_danau','id')->withDefault([
        'nama_danau' => ''
    ]);
}
public function asets_embung(){
    return $this -> belongsTo('App\Models\AsetsEmbung','id_embung','id')->withDefault([
        'nama_embung' => ''
    ]);
}
public function asets_pantai(){
    return $this -> belongsTo('App\Models\AsetsPantai','id_pantai','id')->withDefault([
        'nama_bangunan' => ''
    ]);
}
public function asets_sungai(){
    return $this -> belongsTo('App\Models\AsetsSungai','id_sungai','id')->withDefault([
        'nama_sungai' => ''
    ]);
}
public function asets_airtanah(){
    return $this -> belongsTo('App\Models\AsetsAirTanah','id_airtanah','id')->withDefault([
        'nama_bangunan' => ''
    ]);
}
public function asets_airbaku(){
    return $this -> belongsTo('App\Models\AsetsAirBaku','id_airbaku','id')->withDefault([
        'nama_bangunan' => ''
    ]);
}
}