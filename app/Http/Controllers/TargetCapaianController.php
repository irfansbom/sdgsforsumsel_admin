<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use App\Models\Kabs;
use App\Models\Target;
use App\Models\TargetCapaian;
use App\Models\Tujuan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class TargetCapaianController extends Controller
{

    public function index(Request $request)
    {
        $auth = Auth::user();
        $filter_indikator = $request->indikator_filter;
        $filter_target = $request->target_filter;
        $filter_tujuan = $request->tujuan_filter;

        $kabs = Kabs::all();
        $tujuans = Tujuan::all();
        $targets = Target::where('id_tujuan', $filter_tujuan)->get();
        $indikators = Indikator::where('id_target', $filter_target)->get();
        $select_indikator = Indikator::where('id_indikator', $filter_indikator)->first();
        $data = TargetCapaian::where('id_indikator', $filter_indikator)->orderby('tahun')->orderby('kd_wilayah')->paginate(15);
        return view('target_capaian.index', compact('auth', 'kabs', 'tujuans', 'targets', 'indikators', 'select_indikator', 'data', 'kabs'));
    }

    public function create()
    {
        $auth = Auth::user();
        $indikator = new Indikator();
        $tujuans = Tujuan::all();
        $targets = Target::all();
        return view('target_capaian.create', compact('auth', 'indikator', 'tujuans'));
    }

    public function store(Request $request)
    {
        $auth = Auth::user();
        try {
            $data = TargetCapaian::create([
                'id_tujuan' => $request->id_tujuan,
                'id_target' => $request->id_target,
                'id_indikator' => $request->id_indikator,
                'tahun' => $request->tahun,
                'kd_wilayah' => $request->kd_wilayah,
                'target' => $request->target,
                'capaian' => $request->capaian,
                'created_by' => $auth->id,
            ]);
            return redirect()->back()->with('success', 'Berhasil Disimpan');
        } catch (QueryException $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function show($id)
    {
        $auth = Auth::user();
        $real_id = Crypt::decryptString($id);
        $indikator = Indikator::find($real_id);
        $tujuans = Tujuan::all();
        $targets = Target::where('id_tujuan', $indikator->id_tujuan)->get();
        return view('target_capaian.show', compact('auth', 'id', 'tujuans', 'targets', 'indikator'));
    }

    public function update($id, Request $request)
    {
        $auth = Auth::user();
        try {
            $data = TargetCapaian::find($id);
            $data->update(
                [
                    'id_tujuan' => $request->id_tujuan,
                    'id_target' => $request->id_target,
                    'id_indikator' => $request->id_indikator,
                    'tahun' => $request->tahun,
                    'kd_wilayah' => $request->kd_wilayah,
                    'target' => $request->target,
                    'capaian' => $request->capaian,
                    'updated_by' => $auth->id,
                ]
            );
            return redirect()->back()->with('success', 'Berhasil Diupate');
        } catch (QueryException $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        $data = TargetCapaian::where('id', $request->id)->delete();
        if ($data > 0) {
            return redirect()->back()->with('success', 'Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal Dihapus');
        }
    }
}
