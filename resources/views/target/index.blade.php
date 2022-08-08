@extends('layout.layout')

@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Target</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('target') }}">Target</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </div>
                </div>
                @include('alert')
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <div class="card-header">
                                <h3 class="card-title mb-0">List Target</h3>
                                <div class="ms-auto pageheader-btn">
                                    @if ($auth->can('target_add'))
                                        <a class="btn btn-primary btn-icon text-white me-2"
                                            href="{{ url('target/create') }}">
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
                                                <th style="width: 16%">ID Target</th>
                                                <th style="width: 70%">Nama Target</th>
                                                <th style="width: 8%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-top">
                                            @foreach ($targets as $key => $tar)
                                                <tr class="align-top">
                                                    <td class="text-center align-middle">{{ ++$key }}</td>
                                                    <td class="text-center align-middle">
                                                        {{ $tar->id_target }}
                                                    </td>
                                                    <td class="align-top"
                                                        style="word-break: break-word; overflow-wrap: break-word; white-space:initial">
                                                        {{ $tar->nama_target }}</td>
                                                    <td class="text-center">
                                                        @if ($auth->can('target_edit'))
                                                            <a class="btn btn-outline-primary "
                                                                href="{{ url('target/' . \Crypt::encryptString($tar->id)) }}">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        @endif
                                                        @if ($auth->can('target_delete'))
                                                            <button class="btn btn-outline-danger  btn_hapus"
                                                                data-id="{{ $tar->id }}"
                                                                data-nama="{{ $tar->nama_target }}" data-bs-toggle="modal"
                                                                data-bs-target="#modal_hapus">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $targets->links() }}
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
                    <form action="{{ url('target/delete') }}" method="post" id="form_hapus">
                        @csrf
                        <div class="row ">
                            <input type="text" name="id" id="hapus_id" hidden>
                            <div class="mb-3 ">
                                <label for="hapus_nama" class="form-label">Nama Target</label>
                                <input type="text" class="form-control" id="hapus_nama" name="nama" readonly>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
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
