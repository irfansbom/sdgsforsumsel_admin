<?php

namespace App\Http\Controllers;

use App\Models\Tujuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class TujuanController extends Controller
{
    //

    public function index()
    {
        $auth = Auth::user();
        $tujuans = Tujuan::all();
        return view('tujuan.index', compact('auth', 'tujuans'));
    }

    public function show($id)
    {
        $auth = Auth::user();
        $id = Crypt::decryptString($id);
        $tujuan = Tujuan::find($id);
        return view('tujuan.show', compact('auth', 'id', 'tujuan'));
    }

    public function update($id, Request $request)
    {
        $auth = Auth::user();
        $id = Crypt::decryptString($id);
        $tujuan = Tujuan::find($id);
        $tujuan->penjelasan = $request->penjelasan;
        $tujuan->updated_by = $auth->id;
        if ($tujuan->save()) {
            return redirect()->back()->with('success', 'Berhasil Diupate');
        } else {
            return redirect()->back()->with('error', 'Gagal Diupdate');
        }
    }
}
