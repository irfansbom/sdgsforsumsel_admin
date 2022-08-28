<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use App\Models\Kabs;
use App\Models\Program;
use App\Models\Target;
use App\Models\Tujuan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $auth = Auth::user();
        $kabs = Kabs::all();
        $tujuans = Tujuan::all();
        $targets = Target::where('id_tujuan', $request->tujuan_filter)->get();
        $indikators = Indikator::where('id_target', $request->target_filter)->get();
        $select_indikator = Indikator::where('id_indikator', $request->indikator_filter)->first();
        $data = Program::where('nama_program', 'LIKE', '%' . $request->nama_filter . '%')
            ->where('id_tujuan', 'LIKE', '%' . $request->tujuan_filter . '%')
            ->orderby('tahun')
            ->paginate(15);
        return view('program.index', compact('auth', 'kabs', 'tujuans', 'targets', 'indikators', 'data', 'select_indikator'));
    }

    public function store(Request $request)
    {
        $auth = Auth::user();
        try {
            $data = Program::create([
                'id_tujuan' => $request->id_tujuan,
                'id_target' => $request->id_target,
                'id_indikator' => $request->id_indikator,
                'nama_program' => $request->nama_program,
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

    public function update($id, Request $request)
    {
        $auth = Auth::user();
        try {
            $data = Program::find($id);
            $data->update(
                [
                    'id_tujuan' => $request->id_tujuan,
                    'id_target' => $request->id_target,
                    'id_indikator' => $request->id_indikator,
                    'nama_program' => $request->nama_program,
                    'pelaku' => $request->pelaku,
                    'anggaran' => $request->anggaran,
                    'tahun' => $request->tahun,
                    'created_by' => $auth->id,
                ]
            );
            return redirect()->back()->with('success', 'Berhasil Diupate');
        } catch (QueryException $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        $data = Program::where('id', $request->id)->delete();
        if ($data > 0) {
            return redirect()->back()->with('success', 'Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal Dihapus');
        }
    }
}
