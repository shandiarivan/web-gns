<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Menampilkan daftar paket, tapi karena kita menampilkannya di halaman G-Net,
     * kita arahkan saja ke sana.
     */
    public function index()
    {
        return redirect()->route('ui-gnet');
    }

    /**
     * Menampilkan form tambah, tapi karena kita pakai modal,
     * kita arahkan saja ke halaman G-Net.
     */
    public function create()
    {
        return redirect()->route('ui-gnet');
    }

    /**
     * Menyimpan paket baru dari form modal.
     */
    public function store(Request $request)
    {
        // PERBAIKAN: Semua aturan validasi digabung menjadi satu.
        $validated = $request->validate([
            'type' => 'required|in:gnet,martabe',
            'name' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'price' => 'required|string|max:50',
            'benefits' => 'required|string',
            'is_published' => 'nullable', // Kita tambahkan ini untuk publish/draft
        ]);

        $validated['is_published'] = $request->has('is_published');

        // PERBAIKAN: Selalu gunakan data yang sudah divalidasi ($validated), bukan $request->all().
        Package::create($validated);

        return redirect()->back()->with('success', 'Paket baru berhasil ditambahkan.');
    }

    public function show(Package $package)
    {
        // Tidak digunakan
    }

    /**
     * Menampilkan halaman/form untuk edit.
     */
    public function edit(Package $package)
    {
        return view('packages.edit', compact('package'));
    }

    /**
     * Memproses perubahan dari form edit.
     */
    public function update(Request $request, Package $package)
    {
        // PERBAIKAN: Semua aturan validasi digabung menjadi satu.
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'price' => 'required|string|max:50',
            'benefits' => 'required|string',
        ]);
        
        // PERBAIKAN: Tambahkan data is_published secara manual
        $validated['is_published'] = $request->has('is_published');
        
        // PERBAIKAN: Gunakan data yang sudah divalidasi ($validated).
        $package->update($validated);

        // Arahkan ke halaman yang sesuai berdasarkan tipe paket
        $redirectRoute = $package->type === 'gnet' ? 'ui-gnet' : 'ui-martabe';
        return redirect()->route($redirectRoute)->with('success', 'Paket berhasil diperbarui.');
    }

    /**
     * Menghapus data paket.
     */
    public function destroy(Package $package)
    {
        $package->delete();

        // Menggunakan redirect()->back() agar bisa kembali ke halaman gnet atau martabe

        $redirectRoute = $package->type === 'gnet' ? 'ui-gnet' : 'ui-martabe';
        return redirect()->back()->with('success', 'Paket berhasil dihapus.');
    }
}