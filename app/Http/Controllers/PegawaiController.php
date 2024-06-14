<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    public function index()  
    {
        $data_pegawai = Pegawai::orderBy('created_at', 'DESC')->get();
        return view('Pegawai.index', compact('data_pegawai'));
    }

    public function create() 
    {
        return view('Pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto'                  => 'image|mimes:jpeg,jpg,png|max:2048',
            'nama_lengkap'          => 'required',
            'nama_panggilan'        => 'required',
            'jabatan'               => 'required',
            'tanggal_lahir'         => 'required',
            'kelamin'               => 'required',
            'alamat'                => 'required',
        ]);

        //upload image
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
    
            // Simpan file ke storage/public/foto_pegawai
            $image->storeAs('public/foto_pegawai', $imageName);
    

        $date = DateTime::createFromFormat('m/d/Y', $request->tanggal_lahir);
        $date->format('Y-m-d');

        Pegawai::create([
            'foto'                   => $imageName,
            'nama_lengkap'           => $request->nama_lengkap,
            'nama_panggilan'         => $request->nama_panggilan,
            'jabatan'                => $request->jabatan,
            'tanggal_lahir'          => $date,
            'kelamin'                => $request->kelamin,
            'alamat'                 => $request->alamat,
        ]);

            return redirect()->route('pegawais.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->back()->with(['error', 'Gagal mengupload foto pegawai.']);
        }
    }

    public function show(string $id)
    {
        //get product by ID
        $pegawai = Pegawai::findOrFail($id);

        //render view with product
        return view('Pegawai.show', compact('pegawai'));
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('Pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'nama_panggilan' => 'required',
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

        $date = DateTime::createFromFormat('m/d/Y', $request->tanggal_lahir);
        $date->format('Y-m-d');

        $pegawai->update([
            'nama_lengkap' => $request->nama_lengkap,
            'jabatan' => $request->jabatan,
            'tanggal_lahir' => $date,
            'kelamin' => $request->kelamin,
            'alamat' => $request->alamat,
            'foto' => $pegawai->foto,
        ]);

        return redirect()->route('pegawais.index')->with('success', 'Data berhasil Diupdate!');
    }

    public function destroy($id)
    {
        $data = Pegawai::findOrFail($id);

        //delete image
        Storage::delete('public/foto_pegawai/'. $data->image);

        //delete data
        $data->delete();

        //redirect to index
        return redirect()->route('pegawais.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
