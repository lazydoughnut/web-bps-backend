<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;
use Illuminate\Http\Request;

class PublikasiController extends Controller
{
    public function index()
{
    $data = Publikasi::all(); 
    return response()->json($data);
}

    //fungsi untuk menyimpan publikasi baru
    public function store(Request $request)
    {
        $validated = $request->validate([
        'title' => 'required|string|max:255',
        'releaseDate' => 'required|date',
        'description' => 'nullable|string',
        'coverUrl' => 'nullable|url',
    ]);

    $publikasi = Publikasi::create($validated);
    return response()->json($publikasi, 201);
    }

    //fungsi untuk menampilkan daftar publikasi
    public function show($id)
    {
        $publikasi = Publikasi::find($id);
        if (!$publikasi) {
            return response()->json(['message' => 'Publikasi tidak ditemukan'], 404);
        }
        return response()->json($publikasi);
    }

    //fungsi untuk mengupdate publikasi
    public function update(Request $request, $id)
    {
        $publikasi = Publikasi::find($id);

        if (!$publikasi) {
            return response()->json(['message' => 'Publikasi tidak ditemukan'], 404);
        }
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'releaseDate' => 'required|date',
            'description' => 'nullable|string',
            'coverUrl' => 'nullable|url',
        ]);

        // Update publikasi
        $publikasi->update($validated);

        //menampilkan pesan sukses
        return response()->json(['message' => 'Publikasi berhasil diperbarui']);

    }

    //fungsi untuk menghapus publikasi
    public function hapus($id)
    {
        $publikasi = Publikasi::find($id);
        if (!$publikasi) {
            return response()->json(['message' => 'Publikasi tidak ditemukan'], 404);
        }
        $publikasi->delete();
        return response()->json(['message' => 'Publikasi berhasil dihapus']);
    }

}