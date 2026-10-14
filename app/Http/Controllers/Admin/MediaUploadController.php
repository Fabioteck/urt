<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MediaUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg,webp,pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $file->getClientOriginalName());
            $path = $file->storeAs('uploads', $filename, 'public');

            return response()->json([
                'success' => true,
                'path' => 'storage/' . $path,
                'url' => asset('storage/' . $path),
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Nessun file caricato.'], 422);
    }
}
