<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // <-- Tambahkan ini untuk helper string

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('ui-beranda.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('ui-beranda.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'description' => 'required|string',
        ]);

        // --- PERUBAHAN DIMULAI ---
        // 1. Simpan gambar dan dapatkan path relatifnya
        $imagePath = $request->file('image')->store('promo_images', 'public');

        // 2. Ubah path relatif menjadi URL lengkap
        $imageUrl = Storage::url($imagePath);

        // 3. Simpan URL lengkap ke database
        Promo::create([
            'image_path' => $imageUrl,
            'description' => $request->description,
            'is_published' => $request->has('is_published'),
        ]);
        // --- PERUBAHAN SELESAI ---

        return redirect()->route('ui-beranda.index')->with('success', 'Konten promo baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promo $promo)
    {
        return view('promos.edit', compact('promo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promo $promo)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'description' => 'required|string',
        ]);

        $dataToUpdate = [
            'description' => $request->description,
            'is_published' => $request->has('is_published'),
        ];

        if ($request->hasFile('image')) {
            // --- PERUBAHAN DIMULAI (LOGIKA HAPUS & SIMPAN) ---
            // 1. Hapus gambar lama
            // Ubah URL lama menjadi path relatif sebelum menghapus
            $oldPath = Str::remove('/storage/', parse_url($promo->image_path, PHP_URL_PATH));
            Storage::disk('public')->delete($oldPath);
            
            // 2. Upload gambar baru dan dapatkan path relatifnya
            $newPath = $request->file('image')->store('promo_images', 'public');

            // 3. Ubah path baru menjadi URL lengkap untuk disimpan
            $dataToUpdate['image_path'] = Storage::url($newPath);
            // --- PERUBAHAN SELESAI ---
        }

        $promo->update($dataToUpdate);

        return redirect()->route('ui-beranda.index')->with('success', 'Konten promo berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promo $promo)
    {
        // --- PERUBAHAN DIMULAI (LOGIKA HAPUS) ---
        // Ubah URL yang tersimpan di database menjadi path relatif
        $relativePath = Str::remove('/storage/', parse_url($promo->image_path, PHP_URL_PATH));
        
        // Hapus file gambar dari storage menggunakan path relatif
        Storage::disk('public')->delete($relativePath);
        // --- PERUBAHAN SELESAI ---

        // Hapus data dari database
        $promo->delete();

        return redirect()->route('ui-beranda.index')->with('success', 'Konten promo berhasil dihapus.');
    }
}