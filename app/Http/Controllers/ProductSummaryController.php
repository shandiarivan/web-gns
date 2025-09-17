<?php

namespace App\Http\Controllers;

use App\Models\ProductSummary;
use Illuminate\Http\Request;

class ProductSummaryController extends Controller
{
    public function index()
    {
        // Ambil data G-Net, atau buat baru jika belum ada
        $gnet = ProductSummary::firstOrCreate(
            ['type' => 'gnet'],
            ['title' => 'G-NET', 'tagline' => 'Koneksi Stabil', 'price' => '250K', 'features' => "100% Fiber Optik\nInternet Unlimited Tanpa FUP"]
        );

        // Ambil data Martabe, atau buat baru jika belum ada
        $martabe = ProductSummary::firstOrCreate(
            ['type' => 'martabe'],
            ['title' => 'Martabe', 'tagline' => 'Kecepatan Tinggi', 'price' => '450K', 'features' => "100% Fiber Optik\nKecepatan Simetris"]
        );

        // return view('product_summaries.index', compact('gnet', 'martabe'));
        return view('ui-paket', compact('gnet', 'martabe'));
    }

    public function update(Request $request, ProductSummary $productSummary)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'price' => 'required|string|max:50',
            'features' => 'required|string',
        ]);

        $productSummary->update($request->all());

        return redirect()->route('product_summaries.index')->with('success', 'Konten paket unggulan berhasil diperbarui.');
    }
}