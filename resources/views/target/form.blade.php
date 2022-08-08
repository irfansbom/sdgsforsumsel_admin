 <fieldset class="p-5">
     <input type="text" name="id" id="id" hidden value="{{ old('id', $targets->id) }}">
     <div class="mb-3 row">
         <label for="id_tujuan" class="col-sm-4 col-form-label">ID Tujuan</label>
         <div class="col-sm-6">
             <select name="id_tujuan" id="id_tujuan" class="form-control select2" required>
                 <option value="">Pilih Tujuan</option>
                 @foreach ($tujuans as $tuj)
                     <option value="{{ $tuj->id }}" @if ($tuj->id == $targets->id_tujuan) selected @endif>
                         [{{ $tuj->id }}] {{ $tuj->nama_tujuan }}
                     </option>
                 @endforeach
             </select>
         </div>
     </div>
     <div class="mb-3 row">
         <label for="id_target" class="col-sm-4 col-form-label">ID Target</label>
         <div class="col-sm-6">
             <input type="text" class="form-control" id="id_target" name="id_target"
                 value="{{ old('id_target', $targets->id_target) }}" autocomplete="off" required>
         </div>
     </div>
     <div class="mb-3 row">
         <label for="nama_target" class="col-sm-4 col-form-label">Nama Target</label>
         <div class="col-sm-6">

             <textarea name="nama_target" id="nama_target" class="form-control" rows="3">{{ $targets->nama_target }}</textarea>
         </div>
     </div>
     <div class="d-grid gap-2 d-md-flex justify-content-md-end">
         <button class="btn btn-primary" type="submit" id="simpanbtn">simpan</button>
         <div class="col-2"></div>
     </div>
 </fieldset>
