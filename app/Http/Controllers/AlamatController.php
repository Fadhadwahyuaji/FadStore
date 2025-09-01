<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Services\RajaOngkirService;
use Illuminate\Http\Request;

class AlamatController extends Controller
{
    public function storeAlamat(Request $request)
    {
        // Validasi field sesuai dengan kolom di tabel 'alamats'
        $validated = $request->validate([
            'nama_penerima' => 'required',
            'no_hp'         => 'required',
            'alamat_lengkap' => 'required',
            'kode_pos'      => 'required',
            'label'         => 'required',
            'provinsi'      => 'required',
            'kota'          => 'required',
        ]);

        $alamatData = [
            'user_id'       => auth()->id(),
            'nama_penerima' => $validated['nama_penerima'],
            'no_hp'         => $validated['no_hp'],
            'alamat_lengkap' => $validated['alamat_lengkap'],
            'kode_pos'      => $validated['kode_pos'],
            'label'         => $validated['label'],
            'tambahan'      => $request->input('tambahan'),
            'provinsi'      => $validated['provinsi'],
            'kota'          => $validated['kota'],
        ];

        Alamat::create($alamatData);

        return redirect()->route('checkout.get')->with('success', 'Alamat berhasil disimpan');
    }


    public function setDefault(Request $request)
    {
        $validated = $request->validate([
            'alamat_id' => 'required|exists:alamats,id'
        ]);

        // Reset semua alamat user menjadi bukan default
        Alamat::where('user_id', auth()->id())->update(['is_default' => false]);

        // Set alamat yang dipilih menjadi default
        Alamat::where('id', $validated['alamat_id'])
            ->where('user_id', auth()->id())
            ->update(['is_default' => true]);

        return response()->json(['success' => true, 'message' => 'Alamat utama berhasil diubah']);
    }

    public function edit($id)
    {
        $alamat = Alamat::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('customer.edit-alamat', compact('alamat'));
    }

    public function update(Request $request, $id)
    {
        $alamat = Alamat::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $validated = $request->validate([
            'nama_penerima' => 'required',
            'no_hp'         => 'required',
            'alamat_lengkap' => 'required',
            'kode_pos'      => 'required',
            'label'         => 'required',
            'provinsi'      => 'required',
            'kota'          => 'required',
        ]);

        $alamat->update([
            'nama_penerima' => $validated['nama_penerima'],
            'no_hp'         => $validated['no_hp'],
            'alamat_lengkap' => $validated['alamat_lengkap'],
            'kode_pos'      => $validated['kode_pos'],
            'label'         => $validated['label'],
            'tambahan'      => $request->input('tambahan'),
            'provinsi'      => $validated['provinsi'],
            'kota'          => $validated['kota'],
            'is_default'    => $request->has('is_default') ? true : $alamat->is_default,
        ]);

        return redirect()->route('checkout.get')->with('success', 'Alamat berhasil diperbarui');
    }

    public function destroy($id)
    {
        $alamat = Alamat::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Jika alamat yang dihapus adalah default, maka set alamat lain sebagai default
        if ($alamat->is_default) {
            $otherAddress = Alamat::where('user_id', auth()->id())
                ->where('id', '!=', $id)
                ->first();

            if ($otherAddress) {
                $otherAddress->update(['is_default' => true]);
            }
        }

        $alamat->delete();

        return response()->json(['success' => true, 'message' => 'Alamat berhasil dihapus']);
    }
}
