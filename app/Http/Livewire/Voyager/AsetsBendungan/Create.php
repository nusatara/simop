<?php

namespace App\Http\Livewire\Voyager\AsetsBendungan;

use Livewire\Component;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\AsetsBendungan;
use DB;
use Auth;

class Create extends Component
{
    public $id_kota;
    public $id_kecamatan;
    public $id_desa;
    public $nama_bendungan;
    public $das;
    public $x;
    public $prov;
    public $tipe;
    public $manfaat_irigasi;
    public $manfaat_airbaku;
    public $manfaat_listrik;
    public $luasgenangan_nwl;
    public $vt_efektif;
    public $vt_total;
    public $elev_puncakbendungan;
    public $elev_spillway;
    public $elev_intake;
    public $ket;
    public $id_jenisaset;
    public $file_pendukung;

    protected $rules = [
        'id_kota' => ['required'],
        'id_kecamatan' => ['required'],
        'id_desa' => ['required'],
        'id_jenisaset' => ['required'],
        'file_pendukung' => ['required'],
        'nama_bendungan' => ['required'],
        'das' => ['required'],
        'prov' => ['required'],
    ];
    
    public function updated($properyName){
        $this->validateOnly($properyName);
    }

    public function render(){
        $kota = Kota::all();
        $kecamatan = Kota::where('id', $this->id_kota)->get();
        $desa = Kecamatan::where('id', $this->id_kecamatan)->get();
        return view('livewire.voyager.asets-bendungan.create',[
        'kota' => $kota,
        'kecamatan' => $kecamatan,
        'desa' => $desa,
        ]);
    }

    public function store(){
        $this->validate([
            'id_kota' => ['required'],
            'id_kecamatan' => ['required'],
            'id_desa' => ['required'],
            'nama_bendungan' => ['required'],
            'id_jenisaset' => ['required'],
            'das' => ['required'],
            'prov' => ['required'],
            'file_pendukung' => ['required'],
        ]);
        $store = DB::table('asets_bendungan')->insert([
            'nama_bendungan'=>$this->nama_bendungan,
            'das'=>$this->das,
            'x'=>$this->x,
            'prov'=>$this->prov,
            'tipe'=>$this->tipe,
            'manfaat_irigasi'=>$this->manfaat_irigasi,
            'manfaat_airbaku'=>$this->manfaat_airbaku,
            'manfaat_listrik'=>$this->manfaat_listrik,
            'luasgenangan_nwl'=>$this->luasgenangan_nwl,
            'vt_efektif'=>$this->vt_efektif,
            'vt_total'=>$this->vt_total,
            'elev_puncakbendungan'=>$this->elev_puncakbendungan,
            'elev_spillway'=>$this->elev_spillway,
            'elev_intake'=>$this->elev_intake,
            'ket'=>$this->ket,
            'file_pendukung'=>$this->file_pendukung,
            'id_jenisaset'=>$this->id_jenisaset,
            'id_kota'=>$this->id_kota,
            'id_kecamatan'=>$this->id_kecamatan,
            'id_desa'=>$this->id_desa,
        ]);
        if($store){
            return redirect()->route('voyager.asets_bendungan.index');
        }
    }
}
