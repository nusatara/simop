<?php

namespace App\Http\Livewire\Voyager\AsetsBendungan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AsetsBendungan;
use App\Models\Das;
// use App\Exports\AsetTanahExport;
// use Maatwebsite\Excel\Facades\Excel;

class Browse extends Component
{
    // protected $listeners = [
    //     'storeSpasialAsetTanah'=> 'store',
    //     'refreshVoyagerAsetTanah'=>'$refresh',
    //     'updateFileAsetTanah'=> 'closeModalFile'
    // ];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $modeMap = false;
    public $search;
    public $paging_size = 8;
    public $row;
    // public $filter_skpd;
    // public $kd_bidang;
    // public $kd_unit;
    // public $kd_sub_unit;
    // public $kd_upb;

    public function updatingSearch()
    {
        $this->resetPage();
        // $this->filter_skpd = '';
    }
    // public function updatedFilterSkpd()
    // {
    //     $upb = Upb::find($this->filter_skpd);
    //     $this->kd_bidang = $upb->kd_bidang;
    //     $this->kd_unit = $upb->kd_unit;
    //     $this->kd_sub = $upb->kd_sub;
    //     $this->kd_upb = $upb->kd_upb;
    //     $this->resetPage();

    // }
    public function render()
    {
        if ($this->search) {
            $data = AsetsBendungan::orderBy('id','desc')
                    ->where('nama_benudngan','like','%'.$this->search.'%')
                    ->paginate($this->paging_size);

        }
        else {
            $data = AsetsBendungan::orderBy('id','desc')->paginate($this->paging_size);
        }

        return view('livewire.voyager.asets-bendungan.browse',[
            'data'=>$data
        ]);
    }

    // public function detail($id){
    //     $this->modeDetail = true;
    //     $this->row = Aset::find($id);
    // }

    // public function backList(){
    //     $this->modeDetail = false;
    //     $this->modeMap = false;
    // }

    public function openMap($id){
       $this->dispatchBrowserEvent('openMap',['id'=>$id]);
    }

    // public function openModalFoto($id){
    //     $this->emit('getAsetTanahIdFoto',$id);
    //     $this->dispatchBrowserEvent('openModalFoto');
    //  }

    //  public function openModalFile($id){
    //     $this->emit('getAsetTanahIdFile',$id);
    //     $this->dispatchBrowserEvent('openModalFile');
    //  }
    //  public function closeModalFile(){
    //     $this->dispatchBrowserEvent('closeModalFile');
    //  }

    public function store($d){
        SpasialAset::create([
            'aset_tanah_id'=> $d[0],
            'geom'=> $d[1],
        ]);
    }

    // public function export()
    // {
    //     return Excel::download(new AsetTanahExport, 'aset-tanah.xlsx');
    // }
}
