<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // <-- Tambahkan ini

class PostController extends Controller
{

    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
        }

        $posts = $query->latest()->paginate(6);

        return view('ui-blog', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'published_at' => 'required|date',
            'image1' => 'nullable|image|max:10240',
            'image2' => 'nullable|image|max:10240',
            'image3' => 'nullable|image|max:10240',
        ]);

        $data = $request->only('title', 'description', 'published_at');
        $data['is_published'] = $request->has('is_published');

        // --- PERUBAHAN DIMULAI (LOGIKA SIMPAN) ---
        foreach (['image1', 'image2', 'image3'] as $imageField) {
            if ($request->hasFile($imageField)) {
                // Simpan file dan dapatkan path relatif
                $path = $request->file($imageField)->store('blog_images', 'public');
                // Ubah path menjadi URL lengkap sebelum disimpan
                $data[$imageField] = Storage::url($path);
            }
        }
        // --- PERUBAHAN SELESAI ---

        Post::create($data);
        return redirect()->route('posts.index')->with('success', 'Postingan blog berhasil dibuat.');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'published_at' => 'required|date',
            'image1' => 'nullable|image|max:10240',
            'image2' => 'nullable|image|max:10240',
            'image3' => 'nullable|image|max:10240',
        ]);

        $data = $request->only('title', 'description', 'published_at');
        $data['is_published'] = $request->has('is_published');

        // --- PERUBAHAN DIMULAI (LOGIKA UPDATE & HAPUS GAMBAR LAMA) ---
        foreach (['image1', 'image2', 'image3'] as $imageField) {
            if ($request->hasFile($imageField)) {
                // Hapus gambar lama jika ada
                if ($post->$imageField) {
                    // Ubah URL menjadi path relatif sebelum menghapus
                    $oldPath = Str::remove('/storage/', parse_url($post->$imageField, PHP_URL_PATH));
                    Storage::disk('public')->delete($oldPath);
                }
                // Upload gambar baru, dapatkan path relatif
                $newPath = $request->file($imageField)->store('blog_images', 'public');
                // Ubah path baru menjadi URL lengkap untuk disimpan
                $data[$imageField] = Storage::url($newPath);
            }
        }
        // --- PERUBAHAN SELESAI ---
        
        $post->update($data);
        return redirect()->route('posts.index')->with('success', 'Postingan blog berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        // --- PERUBAHAN DIMULAI (LOGIKA HAPUS GAMBAR) ---
        foreach (['image1', 'image2', 'image3'] as $imageField) {
            if ($post->$imageField) {
                // Ubah URL menjadi path relatif sebelum menghapus
                $path = Str::remove('/storage/', parse_url($post->$imageField, PHP_URL_PATH));
                Storage::disk('public')->delete($path);
            }
        }
        // --- PERUBAHAN SELESAI ---
        
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Postingan blog berhasil dihapus.');
    }
}