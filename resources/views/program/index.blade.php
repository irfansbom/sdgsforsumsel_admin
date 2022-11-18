@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Program</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('target_capaian') }}">Program</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </div>
                </div>
                @include('alert')
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <div class="card-header d-block">
                                <h3 class="card-title mb-0">List Program</h3>
                                <form action="" id="form_filter">
                                    <fieldset>
                                        <div class="mb-3 row">
                                            <label for="tujuan_filter" class="col-sm-2 col-form-label">Tujuan</label>
                                            <div class="col-sm-7">
                                                <select name="tujuan_filter" id="tujuan_filter" class="form-control select2"
                                                    required>
                                                    <option value="">Pilih Tujuan</option>
                                                    @foreach ($tujuans as $tuj)
                                                        <option value="{{ $tuj->id }}"
                                                            @isset($select_indikator) @if ($tuj->id == $select_indikator->id_tujuan)
                                                            selected @endif
                                                        @endisset>
                                                            [{{ $tuj->id }}]
                                                            {{ $tuj->nama_tujuan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-1">
                                                <button class="btn btn-primary" type="submit">Cari</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="row mb-1">
                                    <div class="col-10"></div>
                                    <div class="col-2 text-end">
                                        @if ($auth->can('program_add'))
                                            <button class="btn btn-primary btn-icon text-white" data-bs-toggle="modal"
                                                data-bs-target="#modal_tambah">
                                                <span>
                                                    <i class="fe fe-plus"></i>
                                                </span> Tambah
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                @if ($data->count() > 0)
                                    <div class="table-responsive">
                                        <table
                                            class="table border table-bordered text-nowrap text-md-nowrap mg-b-0 table-sm">
                                            <thead>
                                                <tr class="text-center align-top">
                                                    <th>No</th>
                                                    <th>Tujuan</th>
                                                    <th>Tahun</th>
                                                    <th>Nama Program</th>
                                                    <th>Anggaran</th>
                                                    <th>Pelaku</th>
                                                    <th style="width: 8%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="align-top">
                                                @foreach ($data as $key => $dt)
                                                    <tr class="align-top">
                                                        <td class="text-center align-middle">{{ ++$key }}</td>
                                                        <td class="text-center align-middle">
                                                            {{ $dt->id_tujuan }}
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            {{ $dt->tahun }}
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            {{ $dt->nama_program }}
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            {{ $dt->anggaran }}
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            {{ $dt->pelaku }}
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($auth->can('program_edit'))
                                                                <button class="btn btn-outline-primary btn_edit"
                                                                    data-id="{{ $dt->id }}"
                                                                    data-id_tujuan="{{ $dt->id_tujuan }}"
                                                                    data-id_target="{{ $dt->id_target }}"
                                                                    data-id_indikator="{{ $dt->id_indikator }}"
                                                                    data-tahun="{{ $dt->tahun }}"
                                                                    data-nama_program="{{ $dt->nama_program }}"
                                                                    data-pelaku="{{ $dt->pelaku }}"
                                                                    data-anggaran="{{ $dt->anggaran }}"
                                                                    data-bs-toggle="modal" data-bs-target="#modal_edit">
                                                                    <i class="fa fa-pencil"></i>
                                                                </button>
                                                            @endif
                                                            @if ($auth->can('indikator_delete'))
                                                                <button class="btn btn-outline-danger btn_hapus"
                                                                    data-id="{{ $dt->id }}" data-bs-toggle="modal"
                                                                    data-bs-target="#modal_hapus">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $data->links() }}
                                    </div>
                                @else
                                    Belum ada data
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_hapus">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('program/delete') }}" method="post" id="form_hapus">
                        @csrf
                        @method('delete')
                        <div class="row ">
                            <input type="text" name="id" id="hapus_id" hidden>
                            <p>Hapus data ini?</p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="form_hapus">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_tambah">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h6 class="modal-title">Tambah Data</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('program') }}" method="post" id="form_tambah">
                        @csrf
                        <div class="row mb-1">
                            <div class="col-sm-2">
                                <label for="modal_tambah_tujuan" class="form-label">Tujuan</label>
                            </div>
                            <div class="col-sm-10">
                                <select name="id_tujuan" id="modal_tambah_tujuan" class="form-control select2"
                                    style="width: 100%" required>
                                    <option value="">Pilih Tujuan</option>
                                    @foreach ($tujuans as $tuj)
                                        <option value="{{ $tuj->id }}">
                                            [{{ $tuj->id }}] {{ $tuj->nama_tujuan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-sm-2">
                                <label for="modal_tambah_target" class="form-label">Target</label>
                            </div>
                            <div class="col-sm-10">
                                <select name="id_target" id="modal_tambah_target" class="form-control select2"
                                    style="width: 100%">
                                    <option value="">Pilih Tujuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-sm-2">
                                <label for="modal_tambah_indikator" class="form-label">Indikator</label>
                            </div>
                            <div class="col-sm-10">
                                <select name="id_indikator" id="modal_tambah_indikator" class="form-control select2"
                                    style="width: 100%">
                                    <option value="">Pilih Tujuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-sm-2">
                                <label for="modal_tambah_nama" class="form-label">Nama Program</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_program" id="modal_tambah_nama">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-sm-2">
                                <label for="modal_tambah_tahun" class="form-label">Tahun</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="tahun" id="modal_tambah_tahun">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-sm-2">
                                <label for="modal_tambah_pelaku" class="form-label">Pelaku Program</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="pelaku" id="modal_tambah_pelaku">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-sm-2">
                                <label for="modal_tambah_anggaran" class="form-label">Anggaran Program</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="anggaran" id="modal_tambah_anggaran">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="form_tambah">Submit</button>
                    <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_edit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form_edit">
                        @csrf
                        @method('put')
                        <div class="row mb-1">
                            <div class="col-sm-2">
                                <label for="modal_edit_tujuan" class="form-label">Tujuan</label>
                            </div>
                            <div class="col-sm-10">
                                <select name="id_tujuan" id="modal_edit_tujuan" class="select2" style="width: 100%"
                                    required>
                                    <option value="">Pilih Tujuan</option>
                                    @foreach ($tujuans as $tuj)
                                        <option value="{{ $tuj->id }}">
                                            [{{ $tuj->id }}] {{ $tuj->nama_tujuan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-sm-2">
                                <label for="modal_edit_target" class="form-label">Target</label>
                            </div>
                            <div class="col-sm-10">
                                <select name="id_target" id="modal_edit_target" style="width: 100%" class="select2">
                                    <option value="">Pilih Tujuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-sm-2">
                                <label for="modal_edit_indikator" class="form-label">Indikator</label>
                            </div>
                            <div class="col-sm-10">
                                <select name="id_indikator" id="modal_edit_indikator" style="width: 100%"
                                    class="select2">
                                    <option value="">Pilih Tujuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-sm-2">
                                <label for="modal_edit_nama" class="form-label">Nama Program</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_program" id="modal_edit_nama">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-sm-2">
                                <label for="modal_edit_tahun" class="form-label">Tahun</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="tahun" id="modal_edit_tahun">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-sm-2">
                                <label for="modal_edit_pelaku" class="form-label">Pelaku Program</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="pelaku" id="modal_edit_pelaku">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-sm-2">
                                <label for="modal_edit_anggaran" class="form-label">Anggaran Program</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="anggaran" id="modal_edit_anggaran">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="form_edit">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .select2-container--open {
            z-index: 9999999
        }

        .select2-dropdown {
            z-index: 9001;
        }
    </style>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#modal_tambah').find("#modal_tambah_id_tujuan").select2({
                dropdownParent: $("#modal_tambah")
            });
            $('#modal_tambah').find("#modal_tambah_id_target").select2({
                dropdownParent: $("#modal_tambah")
            });
            $('#modal_tambah').find("#modal_tambah_id_indikator").select2({
                dropdownParent: $("#modal_tambah")
            });
        });
        var selected_inidkator = {!! json_encode($select_indikator) !!};
        $(function() {
            $('#modal_tambah_tujuan').change(function() {
                get_list_target();
            });
            $('#modal_tambah_target').change(function() {
                get_list_indikator();
            });
            // $('#indikator_filter').change(function() {
            //     $('#form_filter').submit();
            // })
            if (selected_inidkator) {
                get_list_target();
                $('#target_filter').val(selected_inidkator.id_target)
                get_list_indikator();
                $('#indikator_filter').val(selected_inidkator.id_indikator)
            }
        })

        $('.btn_hapus').click(function() {
            $('#modal_hapus').find('#hapus_id').val($(this).data("id"));
            $('#modal_hapus').find('#hapus_nama').val($(this).data("nama"));
        })

        $('.btn_edit').click(function() {
            $("#form_edit").attr('action', "{{ url('program') }}" + "/" + $(this).data('id'));
            $("#modal_edit").find('#modal_edit_tujuan').val($(this).data("id_tujuan")).change();
            get_list_target_edit();
            $("#modal_edit").find('#modal_edit_target').val($(this).data("id_target")).change();
            get_list_indikator_edit();
            $("#modal_edit").find('#modal_edit_indikator').val($(this).data("id_indikator")).change();
            $("#modal_edit").find('#modal_edit_tahun').val($(this).data("tahun"));
            $("#modal_edit").find('#modal_edit_nama').val($(this).data("nama_program"));
            $("#modal_edit").find('#modal_edit_pelaku').val($(this).data("pelaku"));
            $("#modal_edit").find('#modal_edit_anggaran').val($(this).data("anggaran"));
        })

        function get_list_target() {
            $('#modal_tambah_target option').remove()
            $('#modal_tambah_target').append("<option value=''>Pilih Target</option>");
            $.ajax({
                type: "get",
                url: "{{ url('get_target') }}",
                async: false,
                data: {
                    id_tujuan: $('#modal_tambah_tujuan').val()
                },
                success: function(res) {
                    res.data.forEach(element => {
                        $('#modal_tambah_target').append("<option value=" + element.id_target + ">[" +
                            element
                            .id_target + "] " + element.nama_target + "</option>");
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function get_list_target_edit() {
            $('#modal_edit_target option').remove()
            $('#modal_edit_target').append("<option value=''>Pilih Target</option>");
            $.ajax({
                type: "get",
                url: "{{ url('get_target') }}",
                async: false,
                data: {
                    id_tujuan: $('#modal_edit_tujuan').val()
                },
                success: function(res) {
                    res.data.forEach(element => {
                        $('#modal_edit_target').append("<option value=" + element.id_target + ">[" +
                            element
                            .id_target + "] " + element.nama_target + "</option>");
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function get_list_indikator() {
            $('#modal_tambah_indikator option').remove()
            $('#modal_tambah_indikator').append("<option value=''>Pilih Indikator</option>");
            $.ajax({
                type: "get",
                url: "{{ url('get_indikator') }}",
                async: false,
                data: {
                    id_target: $('#modal_tambah_target').val()
                },
                success: function(res) {
                    res.data.forEach(element => {
                        $('#modal_tambah_indikator').append("<option value=" + element.id_indikator +
                            ">[" +
                            element
                            .id_indikator + "] " + element.nama_indikator + "</option>");
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function get_list_indikator_edit() {
            $('#modal_edit_indikator option').remove()
            $('#modal_edit_indikator').append("<option value=''>Pilih Indikator</option>");
            $.ajax({
                type: "get",
                url: "{{ url('get_indikator') }}",
                async: false,
                data: {
                    id_target: $('#modal_edit_target').val()
                },
                success: function(res) {
                    res.data.forEach(element => {
                        $('#modal_edit_indikator').append("<option value=" + element.id_indikator +
                            ">[" +
                            element
                            .id_indikator + "] " + element.nama_indikator + "</option>");
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
@endsection
