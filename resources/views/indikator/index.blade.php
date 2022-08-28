@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Indikator</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('indikator') }}">Indikator</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </div>
                </div>
                @include('alert')
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <div class="card-header">
                                <h3 class="card-title mb-0">List Indikator</h3>
                                <div class="ms-auto pageheader-btn">
                                    @if ($auth->can('indikator_add'))
                                        <a class="btn btn-primary btn-icon text-white me-2"
                                            href="{{ url('indikator/create') }}">
                                            <span>
                                                <i class="fe fe-plus"></i>
                                            </span> Tambah
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table border table-bordered text-nowrap text-md-nowrap mg-b-0 table-sm">
                                        <thead>
                                            <tr class="text-center align-top">
                                                <th>No</th>
                                                <th>ID Indikator</th>
                                                <th>Nama Indikator</th>
                                                <th style="width: 8%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-top">
                                            @foreach ($indikators as $key => $ind)
                                                <tr class="align-top">
                                                    <td class="text-center align-middle">{{ ++$key }}</td>
                                                    <td class="text-center align-middle">
                                                        {{ $ind->id_indikator }}
                                                    </td>
                                                    <td class="align-middle"
                                                        style="word-break: break-word; overflow-wrap: break-word; white-space:initial">
                                                        <a href="target_capaian?indikator_filter={{ $ind->id_indikator }}"
                                                            target="_blank">
                                                            {{ $ind->nama_indikator }}</a>
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($auth->can('indikator_edit'))
                                                            <a class="btn btn-outline-primary "
                                                                href="{{ url('indikator/' . \Crypt::encryptString($ind->id)) }}">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        @endif
                                                        @if ($auth->can('indikator_delete'))
                                                            <button class="btn btn-outline-danger btn_hapus"
                                                                data-id="{{ $ind->id }}"
                                                                data-nama="{{ $ind->nama_indikator }}"
                                                                data-bs-toggle="modal" data-bs-target="#modal_hapus">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $indikators->links() }}
                                </div>
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
                    <h4 class="modal-title">Hapus Target<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('indikator/delete') }}" method="post" id="form_hapus">
                        @csrf
                        @method('delete')
                        <div class="row ">
                            <input type="text" name="id" id="hapus_id" hidden>
                            <div class="mb-3 ">
                                <label for="hapus_nama" class="form-label">Nama Target</label>
                                <input type="text" class="form-control" id="hapus_nama" name="nama" readonly>
                            </div>
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
@endsection

@section('script')
    <script>
        $('.btn_hapus').click(function() {
            console.log($(this).data("id"))
            $('#modal_hapus').find('#hapus_id').val($(this).data("id"));
            $('#modal_hapus').find('#hapus_nama').val($(this).data("nama"));
        })
    </script>
@endsection
