<?php

namespace App\Http\Controllers;

use App\Models\Chatbot;
use Illuminate\Http\Request;

class ChatbotAdminController extends Controller
{
    // Menampilkan halaman dengan semua data
    public function index()
    {
        $responses = Chatbot::latest()->get();
        return view('ui-chatbot', compact('responses'));
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            // Nama input di form Anda harus 'keywords'
            'keywords' => 'required|string', 
            'response' => 'required|string',
        ]);

        Chatbot::create($request->all());
        return redirect()->route('chatbot.index')->with('success', 'Kata kunci baru berhasil ditambahkan.');
    }

    // Menghapus data
    public function destroy(Chatbot $chatbot)
    {
        $chatbot->delete();
        return redirect()->route('chatbot.index')->with('success', 'Kata kunci berhasil dihapus.');
    }
}