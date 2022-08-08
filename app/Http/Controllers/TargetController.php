<?php

namespace App\Http\Controllers;

use App\Models\Target;
use App\Models\Tujuan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class TargetController extends Controller
{
    //
    public function index()
    {
        $auth = Auth::user();
        $query = "CAST(REGEXP_SUBSTR(id_target,'[0-9]+') AS UNSIGNED) ASC, id_target ASC";
        $targets = Target::orderbyraw($query)->paginate(15);
        return view('target.index', compact('auth', 'targets'));
    }

    public function create()
    {
        $auth = Auth::user();
        $targets = new Target();
        $tujuans = Tujuan::all();
        return view('target.create', compact('auth', 'targets', 'tujuans'));
    }

    public function store(Request $request)
    {
        $auth = Auth::user();
        try {
            $target = Target::create([
                'id_target' => $request->id_target,
                'id_tujuan' => $request->id_tujuan,
                'nama_target' => $request->nama_target,
                'created_by' => $auth->id,
            ]);
            return redirect('target')->with('success', 'Berhasil Disimpan');
        } catch (QueryException $ex) {
            return redirect('target/create')->withInput()->with('error', $ex->getMessage());
        }
    }
    public function show($id)
    {
        $auth = Auth::user();
        $id = Crypt::decryptString($id);
        $targets = Target::find($id);
        $tujuans = Tujuan::all();
        return view('target.show', compact('auth', 'targets', 'tujuans'));
    }
    public function update(Request $request)
    {
        $auth = Auth::user();
        try {
            $target = Target::find($request->id);
            $target->id_target = $request->id_target;
            $target->id_tujuan = $request->id_tujuan;
            $target->nama_target = $request->nama_target;
            $target->updated_by = $auth->id;
            $target->save();
            return redirect()->back()->with('success', 'Berhasil Diupate');
        } catch (QueryException $ex) {
            return redirect('target/show' . Crypt::encryptString($request->id))->withInput()->with('error', $ex->getMessage());
        }
    }

    public function delete(Request $request)
    {
        $data = Target::where('id', $request->id)->delete();
        if ($data > 0) {
            return redirect()->back()->with('success', 'Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal Dihapus');
        }
    }
}
