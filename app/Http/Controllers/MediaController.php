<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMediaRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::with('users');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $media = $query->paginate(10);

        return MediaResource::collection($media);
    }

    public function show(Media $medium)
    {
        $medium->load('users');

        return new MediaResource($medium);
    }

    public function store(StoreMediaRequest $request)
    {
        $media = Media::create($request->validated());

        return (new MediaResource($media))
            ->response()
            ->setStatusCode(201);
    }

    public function update(StoreMediaRequest $request, Media $medium)
    {
        $medium->update($request->validated());

        return new MediaResource($medium);
    }

    public function destroy(Media $medium)
    {
        $medium->delete();

        return response()->json([
            'message' => 'Media berhasil dihapus',
        ]);
    }
}
