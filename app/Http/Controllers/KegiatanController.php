<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use App\Models\Kabs;
use App\Models\Kegiatan;
use App\Models\Target;
use App\Models\Tujuan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $auth = Auth::user();
        $kabs = Kabs::all();
        $tujuans = Tujuan::all();
        $targets = Target::where('id_tujuan', $request->tujuan_filter)->get();
        $indikators = Indikator::where('id_target', $request->target_filter)->get();
        $select_indikator = Indikator::where('id_indikator', $request->indikator_filter)->first();
        $data = Kegiatan::where('nama_kegiatan', 'LIKE', '%' . $request->nama_filter . '%')
            ->where('id_tujuan', 'LIKE', '%' . $request->tujuan_filter . '%')
            ->orderby('tahun')
            ->paginate(15);
        return view('kegiatan.index', compact('auth', 'kabs', 'tujuans', 'targets', 'indikators', 'data', 'select_indikator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $auth = Auth::user();
        try {
            $data = Kegiatan::create([
                'id_tujuan' => $request->id_tujuan,
                'id_target' => $request->id_target,
                'id_indikator' => $request->id_indikator,
                'id_program' => $request->id_program,
                'nama_kegiatan' => $request->nama_kegiatan,
                'pelaku' => $request->pelaku,
                'anggaran' => $request->anggaran,
                'tahun' => $request->tahun,
                'created_by' => $auth->id,
            ]);
            return redirect()->back()->with('success', 'Berhasil Disimpan');
        } catch (QueryException $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
