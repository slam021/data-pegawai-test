<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiApiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::all();

        if ($pegawais) {
            return response()->json([
                'success' => true,
                'message' => 'Data Pegawai',
                'data'    => $pegawais
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pegawai belum tersedia',
            ], 401);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto'                  => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama_lengkap'          => 'required',
            'nama_panggilan'        => 'required',
            'jabatan'               => 'required',
            'tanggal_lahir'         => 'required',
            'kelamin'               => 'required',
            'alamat'                => 'required',
        ]);

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
    
            // Simpan file ke storage/public/foto_pegawai
            $image->storeAs('public/foto_pegawai', $imageName);
        }

        $pegawai = Pegawai::create([
            'foto'                   => $imageName,
            'nama_lengkap'           => $request->nama_lengkap,
            'nama_panggilan'         => $request->nama_panggilan,
            'jabatan'                => $request->jabatan,
            'tanggal_lahir'          => $request->tanggal_lahir,
            'kelamin'                => $request->kelamin,
            'alamat'                 => $request->alamat,
        ]);

        if ($pegawai) {
            return response()->json([
                'success' => true,
                'message' => 'Pegawai Berhasil Disimpan!',
                'data'    => $pegawai
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pegawai Gagal Disimpan!',
            ], 401);
        }
    }

    public function show($id)
    {
        try {
            $pegawai = Pegawai::findOrFail($id);
            return response()->json([
                'success' => true,
                'message' => 'Detail Pegawai!',
                'data'    => $pegawai
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Pegawai Tidak Ditemukan!',
                'data'    => null
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan!',
                'data'    => null
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'jabatan' => 'required',
            'tanggal_lahir' => 'required|date',
            'kelamin' => 'required',
            'alamat' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $pegawai = Pegawai::findOrFail($id);
    
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($pegawai->foto) {
                Storage::delete('public/foto_pegawai/'.$pegawai->foto);
            }
            $foto = $request->file('foto');
            $foto->storeAs('public/foto_pegawai', $foto->hashName());
            $pegawai->foto = $foto->hashName();
        }
    
        $pegawai->update([
            'nama_lengkap' => $request->nama_lengkap,
            'jabatan' => $request->jabatan,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kelamin' => $request->kelamin,
            'alamat' => $request->alamat,
            'foto' => $pegawai->foto,
        ]);

        if ($pegawai) {
            return response()->json([
                'success' => true,
                'message' => 'Pegawai Berhasil Diupdate!',
                'data'    => $pegawai
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pegawai Gagal Diupdate!',
            ], 401);
        }
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        if ($pegawai->foto && Storage::exists('public/foto_pegawai/' . $pegawai->foto)) {
            Storage::delete('public/foto_pegawai/' . $pegawai->foto);
        }
        $pegawai->delete();

        if ($pegawai) {
            return response()->json([
                'success' => true,
                'message' => 'Pegawai Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pegawai Gagal Dihapus!',
            ], 400);
        }
    }
}
