<?php

namespace App\Http\Controllers;

use App\Models\Chatbot;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ChatbotAdminController extends Controller
{
    /**
     * Menampilkan halaman daftar kata kunci chatbot.
     */
    public function index()
    {
        $responses = Chatbot::latest()->get();
        return view('ui-chatbot', compact('responses'));
    }

    /**
     * Menyimpan kata kunci baru dari form.
     */
    public function store(Request $request)
    {
        $request->validate([
            'keywords' => 'required|string',
            'response' => 'required|string',
        ]);

        Chatbot::create($request->all());

        return redirect()->route('chatbot.index')->with('success', 'Kata kunci baru berhasil ditambahkan.');
    }

        /**
     * FUNGSI BARU: Menampilkan halaman edit.
     */
    public function edit(Chatbot $chatbot)
    {
        return view('chatbot.edit', compact('chatbot'));
    }

    /**
     * FUNGSI BARU: Memproses update data.
     */
    public function update(Request $request, Chatbot $chatbot)
    {
        $request->validate([
            // Validasi unik, tapi abaikan data yang sedang diedit
            'keywords' => ['required', 'string', Rule::unique('chatbots')->ignore($chatbot->id)],
            'response' => 'required|string',
        ]);

        $chatbot->update($request->all());

        return redirect()->route('chatbot.index')->with('success', 'Kata kunci berhasil diperbarui.');
    }

    /**
     * Menghapus kata kunci.
     */
    public function destroy(Chatbot $chatbot)
    {
        $chatbot->delete();

        return redirect()->route('chatbot.index')->with('success', 'Kata kunci berhasil dihapus.');
    }
}