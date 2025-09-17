<?php
namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request) 
    {
        // 1. Ambil kata kunci pencarian dari input form
        $search = $request->input('search');

        // 2. Mulai query
        $query = Message::latest();

        // 3. Jika ada input pencarian, tambahkan kondisi WHERE
        if ($search) {
            // Gunakan closure untuk mengelompokkan kondisi OR
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // 4. Eksekusi query dengan pagination
        $messages = $query->paginate(15);

        // 5. PENTING: Agar link pagination menyertakan query pencarian
        $messages->appends($request->all());

        // Kirim data messages ke view
        return view('ui-message', compact('messages'));
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return back()->with('success', 'Pesan berhasil dihapus.');
    }
}