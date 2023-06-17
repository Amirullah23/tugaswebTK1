<?php

namespace App\Http\Controllers;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
{
    $videos = Video::all();
    return view('videos.index', compact('videos'));
}

public function store(Request $request)
{
    $request->validate([
        'file_name' => 'required',
        'video' => 'required|mimetypes:video/mp4,video/quicktime|max:50000', // maksimum 50 MB
    ]);

    
    $fileName = time().'.mp4';
    $videoPath = 'videosLocal'.'/'.$fileName;
    // dd($request->file('video'));
    Video::create([
        'file_name' => $request->file_name,
        'video_path' => $videoPath,
    ]);
    $request->file('video')->move(public_path('videosLocal'), $fileName);


    return redirect()->route('videos.index')->with('success', 'Video berhasil diunggah.');
}


public function show($id)
{
    $video = Video::findOrFail($id);
    return view('videos.show', compact('video'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'file_name' => 'required',
        'video' => 'nullable|mimetypes:video/mp4,video/quicktime|max:50000', // maksimum 50 MB
    ]);

    $video = Video::findOrFail($id);

    if ($request->hasFile('video')) {
        $filePath = public_path($video->video_path);
        unlink($filePath);
        $fileName = time().'.mp4';
        $videoPath = 'videosLocal'.'/'.$fileName;
        $request->file('video')->move(public_path('videosLocal'), $fileName);
        $video->update(['video_path' => $videoPath]);
    }

    $video->update(['file_name' => $request->file_name]);

    return redirect()->route('videos.index')->with('success', 'Video berhasil diperbarui.');
}

public function destroy($id)
{
    $video = Video::findOrFail($id);
    $filePath = public_path($video->video_path);
    unlink($filePath);
    $video->delete();

    return redirect()->route('videos.index')->with('success', 'Video berhasil dihapus.');
}
}
