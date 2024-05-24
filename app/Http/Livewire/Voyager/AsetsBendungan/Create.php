<?php

namespace App\Http\Livewire\Voyager\AsetsBendungan;

use Livewire\Component;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\JenisAset;
use App\Models\Das;
use App\Models\AsetsBendungan;
use DB;
use Auth;

class Create extends Component
{
    public $id_kota;
    public $id_kecamatan;
    public $id_desa;
    public $nama_bendungan;
    public $id_das;
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
        'id_das' => ['required'],
        'prov' => ['required'],
    ];
    
    public function updated($properyName){
        $this->validateOnly($properyName);
    }

    public function render(){
        $jenisaset = JenisAset::all();
        $das = Das::all();
        $kota = Kota::all();
        $kecamatan = Kecamatan::where('id_kota', $this->id_kota)->get();
        $desa = Desa::where('id_kota', $this->id_kota)->where('id_kecamatan', $this->id_kecamatan)->get();
        return view('livewire.voyager.asets-bendungan.create',[
        'jenisaset' => $jenisaset,
        'das' => $das,
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
            'id_das' => ['required'],
            'prov' => ['required'],
            'file_pendukung' => ['required'],
        ]);
        $store = DB::table('asets_bendungan')->insert([
            'nama_bendungan'=>$this->nama_bendungan,
            'id_das'=>$this->id_das,
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
