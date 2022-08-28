@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Target & Capaian</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('target_capaian') }}">Target & Capaian</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </div>
                </div>
                @include('alert')
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <div class="card-header d-block">
                                <h3 class="card-title mb-0">List Target & Capaian</h3>
                                <form action="" id="form_filter">
                                    <fieldset>
                                        <div class="mb-1 row">
                                            <label for="tujuan_filter" class="col-sm-2 col-form-label">Tujuan</label>
                                            <div class="col-sm-10">
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
                                    </div>
                                    <div class="mb-1 row">
                                        <label for="target_filter" class="col-sm-2 col-form-label">Target</label>
                                        <div class="col-sm-10">
                                            <select name="target_filter" id="target_filter" class="form-control select2"
                                                required>
                                                <option value="">Pilih Tujuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="indikator_filter" class="col-sm-2 col-form-label">Indikator</label>
                                        <div class="col-sm-10">
                                            <select name="indikator_filter" id="indikator_filter"
                                                class="form-control select2" required>
                                                <option value="">Pilih Tujuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>

                        <div class="card-body">
                            @isset($select_indikator->id_indikator)
                                <div class="row mb-1">
                                    <div class="col-10"></div>
                                    <div class="col-2 text-end">
                                        @if ($auth->can('target_capaian_add'))
                                            <button class="btn btn-primary btn-icon text-white" data-bs-toggle="modal"
                                                data-bs-target="#modal_tambah"
                                                data-id_indikator="{{ $select_indikator->id_indikator }}">
                                                <span>
                                                    <i class="fe fe-plus"></i>
                                                </span> Tambah
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endisset


                            @if ($data->count() > 0)
                                <div class="table-responsive">
                                    <table
                                        class="table border table-bordered text-nowrap text-md-nowrap mg-b-0 table-sm">
                                        <thead>
                                            <tr class="text-center align-top">
                                                <th>No</th>
                                                <th>Tahun</th>
                                                <th>Kode Kabupaten</th>
                                                <th>Target</th>
                                                <th>Capaian</th>
                                                <th style="width: 8%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-top">
                                            @foreach ($data as $key => $dt)
                                                <tr class="align-top">
                                                    <td class="text-center align-middle">{{ ++$key }}</td>
                                                    <td class="text-center align-middle">
                                                        {{ $dt->tahun }}
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        {{ $dt->kd_wilayah }}
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        {{ $dt->target }}
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        {{ $dt->capaian }}
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($auth->can('indikator_edit'))
                                                            <button class="btn btn-outline-primary btn_edit"
                                                                data-id="{{ $dt->id }}"
                                                                data-tahun="{{ $dt->tahun }}"
                                                                data-kd_wilayah="{{ $dt->kd_wilayah }}"
                                                                data-target="{{ $dt->target }}"
                                                                data-capaian="{{ $dt->capaian }}"
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
                <form action="{{ url('target_capaian/delete') }}" method="post" id="form_hapus">
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
                <form action="{{ url('target_capaian') }}" method="post" id="form_tambah">
                    @csrf
                    <div class="row">
                        @isset($select_indikator)
                            <input type="text" name="id_tujuan" id="modal_tambah_id_tujuan"
                                value="{{ $select_indikator->id_tujuan }}" hidden>
                            <input type="text" name="id_target" id="modal_tambah_id_target"
                                value="{{ $select_indikator->id_target }}" hidden>
                            <input type="text" name="id_indikator" id="modal_tambah_id_indikator"
                                value="{{ $select_indikator->id_indikator }}" hidden>
                        @endisset
                        <div class="col-md-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <input type="text" class="form-control" id="modal_tambah_tahun" name="tahun">
                        </div>
                        <div class="col-md-3">
                            <label for="modal_tambah_kd_wilayah" class="form-label">Wilayah</label>
                            <select name="kd_wilayah" id="modal_tambah_kd_wilayah" class="form-control select2">
                                <option value="">Pilih Kabupaten / Kota
                                </option>
                                @foreach ($kabs as $kab)
                                    <option value="{{ $kab->id_kab }}">[{{ $kab->id_kab }}]
                                        {{ $kab->nama_kab }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="modal_tambah_target" class="form-label">Target</label>
                            <input type="text" class="form-control" id="modal_tambah_target" name="target">
                        </div>
                        <div class="col-md-3">
                            <label for="modal_tambah_capaian" class="form-label">Capaian</label>
                            <input type="text" class="form-control" id="modal_tambah_capaian" name="capaian">
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
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Data<span></span></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" id="edit_form">
                    @csrf
                    @method('put')
                    <div class="row">
                        @isset($select_indikator)
                            <input type="text" name="id_tujuan" id="modal_edit_id_tujuan"
                                value="{{ $select_indikator->id_tujuan }}" hidden>
                            <input type="text" name="id_target" id="modal_edit_id_target"
                                value="{{ $select_indikator->id_target }}" hidden>
                            <input type="text" name="id_indikator" id="modal_edit_id_indikator"
                                value="{{ $select_indikator->id_indikator }}" hidden>
                        @endisset
                        <div class="col-md-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <input type="text" class="form-control" id="modal_edit_tahun" name="tahun">
                        </div>
                        <div class="col-md-3">
                            <label for="modal_edit_kd_wilayah" class="form-label">Wilayah</label>
                            <select name="kd_wilayah" id="modal_edit_kd_wilayah" class="form-control select2">
                                <option value="">Pilih Kabupaten / Kota
                                </option>
                                @foreach ($kabs as $kab)
                                    <option value="{{ $kab->id_kab }}">[{{ $kab->id_kab }}]
                                        {{ $kab->nama_kab }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="modal_edit_target" class="form-label">Target</label>
                            <input type="text" class="form-control" id="modal_edit_target" name="target">
                        </div>
                        <div class="col-md-3">
                            <label for="modal_edit_capaian" class="form-label">Capaian</label>
                            <input type="text" class="form-control" id="modal_edit_capaian" name="capaian">
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="edit_form">Submit</button>
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
    var selected_inidkator = {!! json_encode($select_indikator) !!};
    $(function() {
        $('#tujuan_filter').change(function() {
            get_list_target();
        });
        $('#target_filter').change(function() {
            get_list_indikator();
        });
        $('#indikator_filter').change(function() {
            $('#form_filter').submit();
        })
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
        $("#edit_form").attr('action', "{{ url('target_capaian') }}" + "/" + $(this).data('id'));
        $("#modal_edit").find('#modal_edit_tahun').val($(this).data("tahun"));
        $("#modal_edit").find('#modal_edit_kd_wilayah').val($(this).data("kd_wilayah")).change();
        $("#modal_edit").find('#modal_edit_target').val($(this).data("target"));
        $("#modal_edit").find('#modal_edit_capaian').val($(this).data("capaian"));
    })

    function get_list_target() {
        $('#target_filter option').remove()
        $('#target_filter').append("<option value=''>Pilih Target</option>");
        $.ajax({
            type: "get",
            url: "{{ url('get_target') }}",
            async: false,
            data: {
                id_tujuan: $('#tujuan_filter').val()
            },
            success: function(res) {
                res.data.forEach(element => {
                    $('#target_filter').append("<option value=" + element.id_target + ">[" + element
                        .id_target + "] " + element.nama_target + "</option>");
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function get_list_indikator() {
        $('#indikator_filter option').remove()
        $('#indikator_filter').append("<option value=''>Pilih Indikator</option>");
        $.ajax({
            type: "get",
            url: "{{ url('get_indikator') }}",
            async: false,
            data: {
                id_target: $('#target_filter').val()
            },
            success: function(res) {
                res.data.forEach(element => {
                    $('#indikator_filter').append("<option value=" + element.id_indikator + ">[" +
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
