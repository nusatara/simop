<?php

namespace App\Http\Livewire\Voyager\AsetsBendungan;

use Livewire\Component;
use Livewire\WithFileUploads;
use DB;

class Create extends Component
{

    use WithFileUploads;

    public $namaKegiatan;
    public $anggaran;
    public $penyedia;
    public $ket;
    public $pelaksanaanPekerjaan;
    public $waktuPelaksanaan;
    public $noKontrak;
    public $tglKontrak;
    public $bendungan;
    public $irigasi;
    public $danau;
    public $embung;
    public $pantai;
    public $sungai;
    public $airbaku;
    public $airtanah;
    public $koordinat;


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('voyager.kegiatan')->extends('layouts.master');
    }

    public function store(){
        $this->validate([
            'namaKegiatan' => ['required','string','max:250'],
            'noKontrak' => ['required','string','max:250'],
            'tglKontrak' => ['required','string','max:250'],
            'penyedia' => ['required','string','max:250'],
            'anggaran' => ['required','string','max:250'],
            'ket' => 'required|string|max:1500',
            'pelaksana_pekerjaan'=> ['required','string','max:250'],
            'waktu_pelaksanaan'=> ['required','string','max:250'],
        ]);
        $store =DB::table('kegiatan')->insert([
            'nama_kegiatan'=> $this->nama_kegiatan,
            'no_kontrak'=> $this->noKontrak,
            'tgl_kontrak'=> $this->tglKontrak,
            'penyedia'=> $this->penyedia,
            'anggaran'=> $this->anggaran,
            'ket'=> $this->ket,
            'pelaksanaan_pekerjaan'=> $this->pelaksanaanPekerjaan,
            'waktu_pekerjaan'=> $this->waktuPekerjaan,
            'id_aset'=> $bendungan,
            'id_irigasi'=> $irigasi,
            'id_danau'=> $danau,
            'id_embung'=> $embung,
            'id_pantai'=> $pantai,
            'id_sungai'=> $sungai,
            'id_airbaku'=> $airbaku,
            'id_airtanah'=> $airtanah,
            'x'=> $koordinat,
        ]);
        if($store){
            return redirect()->route('voyager.asets_bendungan.index');
        }
    }
}
