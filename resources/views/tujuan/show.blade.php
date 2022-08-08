@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Tujuan</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('tujuan') }}">Tujuan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Show</li>
                        </ol>
                    </div>
                </div>
                @include('alert')
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <form action="{{ url('tujuan/' . \Crypt::encryptString($tujuan->id)) }}" method="POST">
                                @csrf
                                <fieldset class="p-5">
                                    <input type="text" name="id" id="id" hidden
                                        value="{{ old('id', $tujuan->id) }}">
                                    <div class="mb-3 row">
                                        <label for="nama_tujuan" class="col-sm-4 col-form-label">Nama tujuan</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="nama_tujuan" name="nama_tujuan"
                                                disabled value="{{ old('nama_tujuan', $tujuan->nama_tujuan) }}"
                                                autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="penjelasan" class="col-sm-4 col-form-label">Penjelasan</label>
                                        <div class="col-sm-6">
                                            <textarea name="penjelasan" id="penjelasan" class="form-control" rows="20">{{ $tujuan->penjelasan }}</textarea>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button class="btn btn-primary" type="submit" id="simpanbtn">simpan</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ubahpwmodal" tabindex="-1" aria-labelledby="ubahpwmodallabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pwmodallabel">Ubah Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation" id="form_ubah_pw" action="{{ url('/tujuans/ubahpassword') }}"
                        method="POST">
                        @csrf<input type="text" name="id" id="id_form_ubah_pw" hidden
                            value="{{ old('id', $tujuan->id) }}">
                        <input type="text" class="form-control" name="password" value="{{ old('password') }}"
                            id="password_form_ubah_pw">
                        <input type="text" class="form-control" name="password_confirm"
                            id="password_confirm_form_ubah_pw" value="{{ old('password_confirm') }}">
                        <button class="btn btn-danger" type="submit" id="submit_ubah_pw">Ubah Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script></script>
@endsection
