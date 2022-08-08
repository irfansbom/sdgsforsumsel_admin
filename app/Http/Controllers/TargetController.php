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
        $targets = Target::paginate(15);
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
            return redirect('target')->with('message', 'Berhasil Disimpan');
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
    public function update($id, Request $request)
    {
        $auth = Auth::user();
        $id = Crypt::decryptString($id);
        $tujuan = Tujuan::find($id);
        $tujuan->penjelasan = $request->penjelasan;
        $tujuan->save();
        return redirect()->back()->with('success', 'Berhasil Diupate');
    }

    public function delete(Request $request)
    {
        Target::where('id', $request->id)->delete();
        return redirect()->back()->with('success', 'Berhasil Dihapus');
    }
}
