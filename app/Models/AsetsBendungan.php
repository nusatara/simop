<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Spatial;
use App\Models\Scopes;
use App\Models\Scopes\KotaScope;


class AsetsBendungan extends Model
{
use HasFactory,Resizable,Spatial;
protected $table =  "asets_bendungan";
protected $spatial = ['x'];

public function kecamatan(){
    return $this->belongsTo(Kecamatan::class,'id_kecamatan','id_kecamatan');
}
public function kota(){
    return $this->belongsTo(Kota::class,'id_kota','id_kota');
}
public function desa(){
    return $this->belongsTo(Desa::class,'id_desa','id_desa');
}


protected static function booted()
{
    static::addGlobalScope(new KotaScope);
}

public function scopeFilterUpb($query,$id_kota,$id_kecamatan,$id_desa)
{
    $query->whereIdKota($id_kota)->whereIdKecamatan($id_kecamatan)->whereIdDesa($id_desa);
}
}