<?php

namespace App\Http\Controllers\Api; 


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chatbot;

class ChatbotController extends Controller
{
    /**
     * Menerima pesan dari user dan mengembalikan jawaban dari database.
     */
    public function getResponse(Request $request)
    {
        // Validasi input, pastikan ada 'message' yang dikirim
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $userMessage = strtolower($request->input('message'));
        $allKeywords = Chatbot::all();
        
        // Cari respons yang cocok dengan kata kunci
        foreach ($allKeywords as $item) {
            // Ubah string keywords (yg dipisah koma) menjadi array dan trim spasi
            $keywords = array_map('trim', explode(',', strtolower($item->keywords)));
            
            foreach ($keywords as $keyword) {
                // Jika pesan pengguna mengandung salah satu kata kunci
                // dan kata kunci itu tidak kosong
                if (!empty($keyword) && str_contains($userMessage, $keyword)) {
                    // Jika kata kuncinya bukan '*default*', langsung gunakan respons ini
                    if ($keyword !== '*default*') {
                        return response()->json(['reply' => $item->response]);
                    }
                }
            }
        }

        // Jika loop selesai dan tidak ada yang cocok, cari respons default
        $defaultResponse = Chatbot::where('keywords', '*default*')->first();
        if ($defaultResponse) {
            return response()->json(['reply' => $defaultResponse->response]);
        }

        // Fallback jika respons default tidak diset di database
        return response()->json(['reply' => 'Maaf, saya tidak mengerti.']);
    }
}