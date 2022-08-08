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
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card ">
                            <div class="card-header">
                                <h3 class="card-title mb-0">List Tujuan</h3>
                                <div class="ms-auto pageheader-btn">
                                    {{-- <a class="btn btn-primary btn-icon text-white me-2" href="{{ url('users/create') }}"
                                        data-bs-target="#modal_tambah">
                                        <span>
                                            <i class="fe fe-plus"></i>
                                        </span> Tambah
                                    </a> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table border table-bordered text-nowrap text-md-nowrap mg-b-0 table-sm">
                                        <thead>
                                            <tr class="text-center align-top">
                                                <th>No</th>
                                                <th style="width: 16%">Tujuan</th>
                                                <th style="width: 70%">Pencapaian</th>
                                                <th style="width: 8%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-top">
                                            @foreach ($tujuans as $key => $tuj)
                                                <tr class="align-top">
                                                    <td class="text-center align-top">{{ ++$key }}</td>
                                                    <td class="align-top"
                                                        style="word-wrap: break-word; overflow-wrap: break-word; white-space:initial">
                                                        {{ $tuj->nama_tujuan }}
                                                    </td>
                                                    <td class="align-top"
                                                        style="word-break: break-word; overflow-wrap: break-word; white-space:initial">
                                                        {{ $tuj->penjelasan }}</td>
                                                    <td class="text-center">
                                                        <a class="btn btn-outline-primary "
                                                            href="{{ url('tujuan/' . \Crypt::encryptString($tuj->id)) }}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
            </div>
            <!-- ROW-5 END -->
        </div>
        <!-- CONTAINER END -->
    </div>

    <div class="modal fade" id="modal_edit_roles">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Roles<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ url('users/roles') }}" method="post" id="edit_form_roles">
                        @csrf
                        <div class="row ">
                            <input type="text" name="user_id" id="user_id" hidden>
                            <div class="mb-3 ">
                                <label for="nama_user" class="form-label">Nama user</label>
                                <input type="text" class="form-control" id="user_name" name="nama" readonly>
                            </div>

                        </div>
                        Roles
                        {{-- @foreach ($data_roles as $role)
                            <div class="form-check">
                                <input class="form-check-input roles" type="checkbox" value="{{ $role->name }}"
                                    name="roles[]" id="{{ $role->name }}">
                                <label class="form-check-label" for="{{ $role->name }}">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach --}}

                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="edit_form_roles">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="modal_hapus">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus User<span></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('users/delete') }}" method="post" id="form_hapus">
                        @csrf
                        <div class="row ">
                            <input type="text" name="user_id" id="user_id" hidden>
                            <div class="mb-3 ">
                                <label for="nama_user" class="form-label">Nama user</label>
                                <input type="text" class="form-control" id="user_name" name="nama" readonly>
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
    </div> --}}
@endsection

@section('script')
    <script>
        $('.btn_roles').click(function() {
            console.log($(this).data("id"))
            $('#modal_edit_roles').find('#user_id').val($(this).data("id"));
            $('#modal_edit_roles').find('#user_name').val($(this).data("nama"));
            var roles = [];
            $(this).data("roles").forEach(element => {
                roles.push(element['name']);
            });
            $('#modal_edit_roles').find('input[name="roles[]"]').each(function() {
                if (roles.includes(this.value)) {
                    $(this).prop('checked', true);
                } else {
                    $(this).prop('checked', false);
                }
            });
        })

        $('.btn_hapus').click(function() {
            console.log($(this).data("id"))
            $('#modal_hapus').find('#user_id').val($(this).data("id"));
            $('#modal_hapus').find('#user_name').val($(this).data("nama"));

        })
    </script>
@endsection
