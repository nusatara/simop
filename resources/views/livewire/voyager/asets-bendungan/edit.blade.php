<div>
    <form wire:submit.prevent='store'>
   <div class="panel-body">
        <div class="row">
            {{-- Edit --}}
            <div class="form-group col-lg-4 col-md-4">
                <label>Jenis Aset</label>
                <select wire:model="id_jenisaset" class="form-control">
                    <option value="">--- Pilih ---</option>
                    @foreach ($jenisaset as $j)
                        <option value="{{ $j->id }}">{{ $j->nama_asets }}</option>
                    @endforeach
                </select>
                @error('id_jenis_aset')
                    <div class="alert alert-warning" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div> 
            <div class="form-group col-lg-4 col-md-4">
                <label>Nama Bendungan</label>
                <input type="text" class="form-control"  wire:model='nama_bendungan'>
                @error('nama_bendungan')
                    <div class="alert alert-warning" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-lg-4 col-md-4">
                <label>DAS</label>
                <select wire:model="id_das" class="form-control">
                    <option value="">--- Pilih ---</option>
                    @foreach ($das as $da)
                        <option value="{{ $da->id }}">{{ $da->name }}</option>
                    @endforeach
                </select>
                @error('id_das')
                    <div class="alert alert-warning" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-lg-4 col-md-4">
                <label>Provinsi</label>
                <input type="text" class="form-control"  wire:model='provinsi'>
                @error('provinsi')
                <div class="alert alert-warning" role="alert">
                    {{ $message }}
                </div>
                @enderror
             </div>
             {{-- end --}}

             @if (Auth::user()->hasRole(['admin','user']))
            <div class="form-group col-lg-4 col-md-4">
                <label>Kota</label>
                <select wire:model="id_kota" class="form-control">
                    <option value="">--- Pilih ---</option>
                    @foreach ($kota as $k)
                        <option value="{{ $k->id }}">{{ $k->name }}</option>
                    @endforeach
                </select>
                @error('id_kota')
                    <div class="alert alert-warning" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-lg-4 col-md-4">
                <label>Kecamatan</label>
                <select wire:model="id_kecamatan" class="form-control">
                    <option value="">--- Pilih ---</option>
                    @foreach ($kecamatan as $kec)
                        <option value="{{ $kec->id }}">{{ $kec->name }}</option>
                    @endforeach
                </select>

                @error('id_kecamatan')
                    <div class="alert alert-warning" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-lg-4 col-md-4">
                <label>Desa</label>
                <select wire:model="id_desa" class="form-control">
                    <option value="">--- Pilih ---</option>
                    @foreach ($desa as $d)
                        <option value="{{ $d->id}}">{{ $d->name }}</option>
                    @endforeach
                </select>
                @error('id_desa')
                    <div class="alert alert-warning" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @endif

             <div class="form-group col-lg-4 col-md-4">
                <label>Tipe Urugan</label>
                <input type="text" class="form-control"  wire:model='tipe'>
                @error('tipe')
                    <div class="alert alert-warning" role="alert">
                        {{ $message }}
                    </div>
                @enderror
             </div>
             <div class="form-group col-lg-4 col-md-4">
                <label>Manfaat Irigasi</label>
                <input type="text"class="form-control"  wire:model='manfaat_irigasi'>
                @error('manfaat_irigasi')
                    <div class="alert alert-warning" role="alert">
                        {{ $message }}
                    </div>
                @enderror
             </div>
             <div class="form-group col-lg-4 col-md-4">
                <label>Manfaat Air Baku</label>
                <input type="text" class="form-control"  wire:model='manfaat_airbaku'>
                @error('manfaat_airbaku')
                    <div class="alert alert-warning" role="alert">
                        {{ $message }}
                    </div>
                @enderror
             </div>

             <div class="form-group col-lg-4 col-md-4">
                <label>Manfaat Listrik</label>
                <input type="text" class="form-control"  wire:model='manfaat_listrik'>
                @error('manfaat_listrik')
                    <div class="alert alert-warning" role="alert">
                        {{ $message }}
                    </div>
                @enderror
             </div>
             <div class="form-group col-lg-4 col-md-4">
                <label>Luas Genangan NWL</label>
                <input type="text" class="form-control"  wire:model='luasgenangan_nwl'>
                @error('luasgenangan_nwl')
                    <div class="alert alert-warning" role="alert">
                        {{ $message }}
                    </div>
                @enderror
             </div>

             <div class="form-group col-lg-4 col-md-4">
                <label>Volume Tampungan Efektig</label>
                <input type="text"class="form-control"  wire:model='vt_efektif'>
                @error('vt_efektif')
                    <div class="alert alert-warning" role="alert">
                        {{ $message }}
                    </div>
                @enderror
             </div>
             <div class="form-group col-lg-4 col-md-4">
                <label>Volume Tampungan Total</label>
                <input type="text"class="form-control"  wire:model='vt_total'>
                @error('vt_total')
                    <div class="alert alert-warning" role="alert">
                        {{ $message }}
                    </div>
                @enderror
             </div>
             <div class="form-group col-lg-4 col-md-4">
                <label>Elevasi Puncak Bendungan</label>
                <input type="text"class="form-control"  wire:model='elev_puncakbendungan'>
                @error('elev_puncakbendungan')
                    <div class="alert alert-warning" role="alert">
                        {{ $message }}
                    </div>
                @enderror
             </div>
             <div class="form-group col-lg-4 col-md-4">
                <label>Elevasi Spillway</label>
                <input type="text"class="form-control"  wire:model='elev_spillway'>
                @error('elev_spillway')
                    <div class="alert alert-warning" role="alert">
                        {{ $message }}
                    </div>
                @enderror
             </div>
             <div class="form-group col-lg-4 col-md-4">
                <label>Elevasi Intake</label>
                <input type="text"class="form-control"  wire:model='elev_intake'>
                @error('elev_intake')
                    <div class="alert alert-warning" role="alert">
                        {{ $message }}
                    </div>
                @enderror
             </div>
             <div class="form-group col-lg-6 col-md-6">
                <label>Keterangan</label>
                <textarea class="form-control"  wire:model='ket' rows="6"> </textarea>
                @error('ket')
                    <div class="alert alert-warning" role="alert">
                        {{ $message }}
                    </div>
                @enderror
             </div>
        </div>
   </div>
   <div class="panel-footer">
    @section('submit-buttons')
        <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
        <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('voyager.asets-bendungan.index') }}'">Kembali</button>
    @stop
    @yield('submit-buttons')
</div>
</form>
</div>
