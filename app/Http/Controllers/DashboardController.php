<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message; 
use App\Models\Post;    
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function getRealtimeData()
    {
        // 1. Mengambil 3 pesan terbaru
        $latestMessages = Message::latest()->take(3)->get();

        // 2. Mengambil 3 postingan blog terbaru
        $latestPosts = Post::latest()->take(3)->get();
        
        // // 3. Menyiapkan data statistik pengunjung (disimulasikan untuk contoh ini)
        // // Di aplikasi nyata, Anda akan mengambil ini dari database atau layanan analitik.
        // $visitorStats = [
        //     'categories' => [],
        //     'data' => []
        // ];
        // for ($i = 6; $i >= 0; $i--) {
        //     // Membuat label tanggal untuk 7 hari terakhir
        //     $date = Carbon::now()->subDays($i);
        //     $visitorStats['categories'][] = $date->format('d M'); // Contoh: 16 Sep
        //     // Membuat data pengunjung acak untuk demonstrasi
        //     $visitorStats['data'][] = rand(50, 200);
        // }

        // 4. Mengembalikan semua data dalam format JSON
        return response()->json([
            'latestMessages' => $latestMessages,
            'latestPosts'    => $latestPosts,
            //'visitorStats'   => $visitorStats,
        ]);
    }
}