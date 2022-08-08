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
                                                        @if ($auth->can('tujuan_edit'))
                                                            <a class="btn btn-outline-primary "
                                                                href="{{ url('tujuan/' . \Crypt::encryptString($tuj->id)) }}">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        @endif
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
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script></script>
@endsection
