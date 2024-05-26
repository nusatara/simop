<div>
    <div class="row">
        {{-- @if (Auth::user()->hasRole(['admin','superadmin']))
        <div class="col-lg-5 col-md-6">
            <select wire:model="filter_skpd" class="form-control">
                <option value="">--- Pilih ---</option>
                @foreach (App\Models\Upb::orderBy('nm_upb')->get() as $u)
                    <option value="{{ $u->id }}">{{ $u->nm_upb }}</option>
                @endforeach
            </select>
        </div>
        @else

        @endif --}}
        <div class="col-lg-5 col-md-6">
            <input type="text" placeholder="Cari Aset Tanah..." class="form-control" wire:model='search'>
        </div>
        {{-- <div class="col-lg-2">
            <a class="btn btn-success" href="{{ route('export.aset-tanah') }}">Export to Excel</a>
        </div> --}}
    </div>
    <hr>
    <div wire:loading>Mengambil data...
    </div>
     <table class="table">
      <thead>
          <tr>
              <th>Nama Bendungan</th>
              <th>DAS</th>
              <th>Kabupaten / Kota</th>
              <th>Profil Aset</th>
              <th width="170"></th>
          </tr>
      </thead>
      <tbody>
          @foreach ($data as $i)
          <tr>
              <td>{{ $i->nama_bendungan }}</td>
              <td>{{ App\Models\JenisAset::where('id',$i->id_das)->get('nama_asets') }}</td>
              <td>{{App\Models\Kota::where('id',$i->id_kota)->get('name') }}</td>
              <td><a href="{{$i->file_pendukung }}"><i class="voyager-download"></i></a> </td>
              <td>
                <div class="btn-group" role="group" aria-label="...">
                  <button class="btn btn-info btn-sm"> <i class="voyager-location"></i> </button>
                  <button class="btn btn-info btn-sm" onclick="window.location.href='{{ route('voyager.kegiatan.index') }}'"> <i class="voyager-info-circled"></i> </button>
                  <button class="btn btn-info btn-sm" onclick="window.location.href='{{ route('voyager.asets-bendungan.edit',$i->id) }}'"> <i class="voyager-edit"></i> </button>
                  <a href="javascript:;" title="Delete" class="btn btn-sm btn-info delete" data-id="{{ $i->id }}" id="delete-{{ $i->id }}">
                    <i class="voyager-trash"></i>
                </a>
                </div>

                </td>
          </tr>
          @endforeach

      </tbody>
     </table>
     <hr>
     {{ $data->links() }}

    <div class="modal fade" id="modalMap" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-location"></i> Map</h4>
                </div>
                <div class="modal-body" id="map-wrapper">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-images"></i> Foto</h4>
                </div>
                <livewire:voyager.aset-tanah.foto>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalFile" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-file-text"></i> Sertifikat</h4>
                </div>
                <livewire:voyager.aset-tanah.file>
            </div>
        </div>
    </div> --}}
 </div>
 <script>
//     window.addEventListener('openModalFile',event=>{
//         $("#modalFile").modal('show');
//     });
//     window.addEventListener('closeModalFile',event=>{
//         $("#modalFile").modal('hide');
//     });
//    window.addEventListener('openModalFoto',event=>{
//         $("#modalFoto").modal('show');
//     });

</script>

