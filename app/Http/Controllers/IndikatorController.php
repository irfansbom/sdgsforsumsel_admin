<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use App\Models\Program;
use App\Models\Target;
use App\Models\Tujuan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class IndikatorController extends Controller
{

    public function index()
    {
        $auth = Auth::user();
        $query = "CAST(REGEXP_SUBSTR(id_indikator,'[0-9]+') AS UNSIGNED) ASC, id_indikator ASC";
        $indikators = Indikator::orderbyraw($query)->paginate(15);
        return view('indikator.index', compact('auth', 'indikators'));
    }

    public function create()
    {
        $auth = Auth::user();
        $indikator = new Indikator();
        $tujuans = Tujuan::all();
        $targets = Target::all();
        return view('indikator.create', compact('auth', 'indikator', 'tujuans'));
    }

    public function store(Request $request)
    {
        $auth = Auth::user();
        try {
            $data = Indikator::create([
                'id_tujuan' => $request->id_tujuan,
                'id_target' => $request->id_target,
                'id_indikator' => $request->id_indikator,
                'nama_indikator' => $request->nama_indikator,
                'sumber_data' => $request->sumber_data,
                'satuan_data' => $request->satuan_data,
                'range_min' => $request->range_min,
                'range_max' => $request->range_max,
                'legenda' => $request->legenda,
                'flag' => $request->flag,
                'created_by' => $auth->id,
            ]);
            return redirect('indikator')->with('success', 'Berhasil Disimpan');
        } catch (QueryException $ex) {
            return redirect('indikator/create')->withInput()->with('error', $ex->getMessage());
        }
    }

    public function show($id)
    {
        $auth = Auth::user();
        $real_id = Crypt::decryptString($id);
        $indikator = Indikator::find($real_id);
        $tujuans = Tujuan::all();
        $targets = Target::where('id_tujuan', $indikator->id_tujuan)->get();
        return view('indikator.show', compact('auth', 'id', 'tujuans', 'targets', 'indikator'));
    }

    public function update($id, Request $request)
    {
        $auth = Auth::user();
        try {
            $data = Indikator::find(Crypt::decryptString($id));
            $data->update(
                [
                    'id_tujuan' => $request->id_tujuan,
                    'id_target' => $request->id_target,
                    'id_indikator' => $request->id_indikator,
                    'nama_indikator' => $request->nama_indikator,
                    'sumber_data' => $request->sumber_data,
                    'satuan_data' => $request->satuan_data,
                    'range_min' => $request->range_min,
                    'range_max' => $request->range_max,
                    'legenda' => $request->legenda,
                    'flag' => $request->flag,
                    'updated_by' => $auth->id,
                ]
            );
            return redirect()->back()->with('success', 'Berhasil Diupate');
        } catch (QueryException $ex) {
            return redirect('indikator/show' . Crypt::encryptString($request->id))->withInput()->with('error', $ex->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        $data = Indikator::where('id', $request->id)->delete();
        if ($data > 0) {
            return redirect()->back()->with('success', 'Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal Dihapus');
        }
    }

    public function get_target(Request $request)
    {
        $data = Target::where('id_tujuan', $request->id_tujuan)->get()->toArray();
        return response(
            [
                'data' => $data,
            ],
            200
        );
    }

    public function get_indikator(Request $request)
    {
        $data = Indikator::where('id_target', $request->id_target)->get()->toArray();
        return response(
            [
                'data' => $data,
            ],
            200
        );
    }
    public function get_program(Request $request)
    {
        $data = Program::where('id_tujuan', $request->id_tujuan)->get()->toArray();
        return response(
            [
                'data' => $data,
            ],
            200
        );
    }
}
