<?php

namespace App\Http\Controllers\Penulis;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::query();

        if ($request->filled('cari')) {
            $query->where('judul', 'like', "%{$request->cari}%");
        }

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        if ($request->get('status') === 'terhapus') {
            $query->onlyTrashed();
        }

        $media = $query->latest()->paginate(10)->withQueryString();

        return view('penulis.media.index', compact('media'));
    }

    public function create()
    {
        return view('penulis.media.form', ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $rules = [
            'judul' => 'required|string|max:255',
            'tipe' => 'required|in:foto,video',
        ];

        if ($request->tipe === 'video') {
            $rules['youtube_url'] = 'required|url|max:500';
        } else {
            $rules['file'] = 'required|file|mimes:jpg,jpeg,png,gif,webp|max:51200';
        }

        $request->validate($rules);

        if ($request->tipe === 'video') {
            Media::create([
                'judul' => $request->judul,
                'tipe' => 'video',
                'file_path' => $request->youtube_url,
                'file_name' => $this->extractYoutubeId($request->youtube_url) ?? $request->youtube_url,
                'file_size' => 0,
                'user_id' => session('user.id'),
            ]);
        } else {
            $file = $request->file('file');
            $processed = ImageHelper::processAndStore($file, 'media');

            Media::create([
                'judul' => $request->judul,
                'tipe' => 'foto',
                'file_path' => $processed['path'],
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $processed['size'],
                'user_id' => session('user.id'),
            ]);
        }

        return redirect()->route('penulis.media.index')->with('success', 'Media berhasil diupload.');
    }

    public function edit(string $id)
    {
        $media = Media::findOrFail($id);
        return view('penulis.media.form', ['editMode' => true, 'media' => $media]);
    }

    public function update(Request $request, string $id)
    {
        $media = Media::findOrFail($id);

        $rules = [
            'judul' => 'required|string|max:255',
            'tipe' => 'required|in:foto,video',
        ];

        if ($request->tipe === 'video') {
            $rules['youtube_url'] = 'required|url|max:500';
        } else {
            $rules['file'] = 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:51200';
        }

        $request->validate($rules);

        $data = ['judul' => $request->judul, 'tipe' => $request->tipe];

        if ($request->tipe === 'video') {
            // Delete old file if switching from foto to video
            if ($media->tipe === 'foto' && $media->file_path && !str_starts_with($media->file_path, 'http')) {
                Storage::disk('public')->delete($media->file_path);
            }
            $data['file_path'] = $request->youtube_url;
            $data['file_name'] = $this->extractYoutubeId($request->youtube_url) ?? $request->youtube_url;
            $data['file_size'] = 0;
        } elseif ($request->hasFile('file')) {
            if ($media->file_path && !str_starts_with($media->file_path, 'http')) {
                Storage::disk('public')->delete($media->file_path);
            }
            $file = $request->file('file');
            $processed = ImageHelper::processAndStore($file, 'media');
            $data['file_path'] = $processed['path'];
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $processed['size'];
        }

        $media->update($data);

        return redirect()->route('penulis.media.index')->with('success', 'Media berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $media = Media::findOrFail($id);
        $media->delete();

        return redirect()->route('penulis.media.index')->with('success', 'Media berhasil dihapus.');
    }

    public function restore(string $id)
    {
        $media = Media::onlyTrashed()->findOrFail($id);
        $media->restore();

        return redirect()->route('penulis.media.index')->with('success', 'Media berhasil dipulihkan.');
    }

    public function forceDelete(string $id)
    {
        $media = Media::onlyTrashed()->findOrFail($id);

        if ($media->file_path && !str_starts_with($media->file_path, 'http')) {
            Storage::disk('public')->delete($media->file_path);
        }

        $media->forceDelete();

        return redirect()->route('penulis.media.index', ['status' => 'terhapus'])->with('success', 'Media berhasil dihapus permanen.');
    }

    /**
     * AJAX: Get media list as JSON for media picker modal.
     */
    public function json(Request $request)
    {
        $media = Media::where('tipe', 'foto')
            ->latest()
            ->get()
            ->map(fn ($m) => [
                'id' => $m->id,
                'judul' => $m->judul,
                'file_name' => $m->file_name,
                'file_path' => asset('storage/' . $m->file_path),
                'file_size' => $m->formatted_size,
            ]);

        return response()->json($media);
    }

    /**
     * AJAX: Upload media from berita form.
     */
    public function uploadAjax(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'required|file|mimes:jpg,jpeg,png,gif,webp|max:51200',
        ]);

        $file = $request->file('file');
        $processed = ImageHelper::processAndStore($file, 'media');

        $media = Media::create([
            'judul' => $request->judul,
            'tipe' => 'foto',
            'file_path' => $processed['path'],
            'file_name' => $file->getClientOriginalName(),
            'file_size' => $processed['size'],
            'user_id' => session('user.id'),
        ]);

        return response()->json([
            'id' => $media->id,
            'judul' => $media->judul,
            'file_name' => $media->file_name,
            'file_path' => asset('storage/' . $media->file_path),
            'file_size' => $media->formatted_size,
        ]);
    }

    private function extractYoutubeId(?string $url): ?string
    {
        if (!$url) return null;
        preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([\w-]{11})/', $url, $matches);
        return $matches[1] ?? null;
    }
}
