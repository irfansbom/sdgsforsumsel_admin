 <fieldset class="p-5">
     <input type="text" name="id" id="id" hidden value="{{ old('id', $indikator->id) }}">
     <div class="mb-3 row">
         <label for="id_tujuan" class="col-sm-3 col-form-label">ID Tujuan</label>
         <div class="col-sm-9">
             <select name="id_tujuan" id="id_tujuan" class="form-control select2" required>
                 <option value="">Pilih Tujuan</option>
                 @foreach ($tujuans as $tuj)
                     <option value="{{ $tuj->id }}" @if ($tuj->id == $indikator->id_tujuan) selected @endif>
                         [{{ $tuj->id }}] {{ $tuj->nama_tujuan }}
                     </option>
                 @endforeach
             </select>
         </div>
     </div>
     <div class="mb-3 row">
         <label for="id_target" class="col-sm-3 col-form-label">ID Target</label>
         <div class="col-sm-9">
             <select name="id_target" id="id_target" class="form-control select2" required>
                 <option value="">Pilih Tujuan</option>
             </select>
         </div>
     </div>
     <div class="mb-3 row">
         <label for="id_indikator" class="col-sm-3 col-form-label">ID Indikator</label>
         <div class="col-sm-9">
             <input type="text" class="form-control" value="{{ old('id_indikator', $indikator->id_indikator) }}"
                 name="id_indikator" id="id_indikator">
         </div>
     </div>
     <div class="mb-3 row">
         <label for="nama_indikator" class="col-sm-3 col-form-label">Nama Indikator</label>
         <div class="col-sm-9">
             <textarea name="nama_indikator" id="nama_indikator" class="form-control" rows="3">{{ old('nama_indikator', $indikator->nama_indikator) }}</textarea>
         </div>
     </div>
     <div class="row">
         <label for="" class="col-sm-3 col-form-label"><strong>Data</strong></label>
     </div>
     <div class="row">
         <div class="col-1"></div>
         <label for="sumber_data" class="col-sm-2 col-form-label">Sumber</label>
         <div class="col-sm-9">
             <input type="text" class="form-control" value="{{ old('sumber_data', $indikator->sumber_data) }}"
                 name="sumber_data" id="sumber_data">
         </div>
     </div>
     <div class="row">
         <div class="col-1"></div>
         <label for="satuan_data" class="col-sm-2 col-form-label">Satuan</label>
         <div class="col-sm-9">
             <input type="text" class="form-control" value="{{ old('satuan_data', $indikator->satuan_data) }}"
                 name="satuan_data" id="satuan_data">
         </div>
     </div>
     <div class="row">
         <div class="col-1"></div>
         <label for="range_min" class="col-sm-2 col-form-label">Range Minimum</label>
         <div class="col-sm-9">
             <input type="text" class="form-control" value="{{ old('range_min', $indikator->range_min) }}"
                 name="range_min" id="range_min">
         </div>
     </div>
     <div class="row">
         <div class="col-1"></div>
         <label for="range_max" class="col-sm-2 col-form-label">Range Maximum</label>
         <div class="col-sm-9">
             <input type="text" class="form-control" value="{{ old('range_max', $indikator->range_max) }}"
                 name="range_max" id="range_max">
         </div>
     </div>
     <div class="mb-3 row">
         <div class="col-1"></div>
         <label for="legenda" class="col-sm-2 col-form-label">Skala Legenda</label>
         <div class="col-sm-9">
             <select name="legenda" id="legenda" class="form-control select2 ">
                 <option value="kecil" @if ($indikator->legenda == 'kecil') selected @endif>Semakin Kecil Semakin Baik
                 </option>
                 <option value="besar" @if ($indikator->legenda == 'besar') selected @endif>Semakin Besar Semakin Baik
                 </option>
             </select>
         </div>
     </div>
     <div class="mb-3 row">
         <label for="flag" class="col-sm-3 col-form-label">Visibilitas</label>
         <div class="col-sm-9">
             <select name="flag" id="flag" class="form-control select2 ">
                 <option value="1" @if ($indikator->flag == '1') selected @endif>Terlihat</option>
                 <option value="0" @if ($indikator->flag == '0') selected @endif>Tidak</option>
             </select>
         </div>
     </div>
     <div class="d-grid gap-2 d-md-flex justify-content-md-end">
         <button class="btn btn-primary" type="submit" id="simpanbtn">simpan</button>
     </div>
 </fieldset>
