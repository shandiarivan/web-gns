<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BerandaController extends Controller
{
    public function index(Request $request) // <-- Tambahkan Request $request
    {
        // Mengambil data statistik (ini tidak berubah)
        $settings = \App\Models\Setting::all()->pluck('value', 'key');
        
        // --- Logika Baru untuk Promo dengan Pencarian & Pagination ---
        
        // Mulai query builder untuk model Promo
        $query = \App\Models\Promo::query();

        // Jika ada input pencarian di URL (?search=...)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            
            // Tambahkan kondisi WHERE untuk mencari di kolom 'description'
            $query->where('description', 'like', '%' . $search . '%');
        }

        // Ambil hasilnya, urutkan dari yang terbaru, dan batasi 6 per halaman
        $promos = $query->latest()->paginate(6);

        // Kirim semua data ke view
        return view('ui-beranda', compact('settings', 'promos'));
    }

    public function updateStatistics(Request $request)
    {
        $request->validate([
            'jumlah_kota' => 'required|integer',
            'jumlah_kelurahan' => 'required|integer',
            'jumlah_pelanggan' => 'required|integer',
        ]);

        // Gunakan updateOrCreate untuk memperbarui atau membuat setting jika belum ada
        Setting::updateOrCreate(['key' => 'jumlah_kota'], ['value' => $request->jumlah_kota]);
        Setting::updateOrCreate(['key' => 'jumlah_kelurahan'], ['value' => $request->jumlah_kelurahan]);
        Setting::updateOrCreate(['key' => 'jumlah_pelanggan'], ['value' => $request->jumlah_pelanggan]);

        return redirect()->route('ui-beranda.index')->with('success', 'Data statistik berhasil diperbarui.');
    }

       public function storePromo(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'description' => 'required|string',
        ]);

        // Proses upload gambar
        $imagePath = $request->file('image')->store('promo_images', 'public');

        // Simpan data ke database
        Promo::create([
            'image_path' => $imagePath,
            'description' => $request->description,
            'is_published' => $request->has('is_published'), // Cek apakah checkbox dicentang
        ]);

        return redirect()->route('ui-beranda.index')->with('success', 'Konten promo berhasil ditambahkan.');
    }
}