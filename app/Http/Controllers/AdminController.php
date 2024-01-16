<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    function produk(){
        $produks = Produk::all();

        return view('admin.produk', compact('produks'));
    }

    function tambah_produk(){
        return view('admin.tambah_produk');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|integer',
            'jumlah' => 'required|integer',
        ]);

        $gambarPath = $request->file('gambar')->store('public/Foto_Produk');

        Produk::create([
            'gambar' => $gambarPath,
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
            'jumlah' => $request->input('jumlah'),
        ]);

        return redirect()->route('produk')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus gambar terkait dari storage
        Storage::delete($produk->gambar);

        // Hapus produk dari database
        $produk->delete();

        return redirect()->route('produk')->with('success', 'Produk berhasil dihapus.');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);

        return view('admin.edit_produk', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|integer',
            'jumlah' => 'required|integer',
        ]);

        // Hapus gambar lama jika ada gambar baru yang diunggah
        if ($request->hasFile('gambar')) {
            Storage::delete($produk->gambar);
            $gambarPath = $request->file('gambar')->store('public/Foto_Produk');
            $produk->update(['gambar' => $gambarPath]);
        }

        // Update informasi produk
        $produk->update([
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
            'jumlah' => $request->input('jumlah'),
        ]);

        return redirect()->route('produk')->with('success', 'Produk berhasil diperbarui.');
    }
}
