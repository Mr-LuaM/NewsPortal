<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with(['author', 'tags'])->get();
        return response()->json($news);
    }

    public function show($id)
    {
        $news = News::with(['author', 'tags'])->findOrFail($id);
        return response()->json($news);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'category' => 'nullable|string',
            'author_id' => 'required|exists:authors,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $news = News::create($validated);
        $news->tags()->sync($request->tags);

        return response()->json($news->load('tags', 'author'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'category' => 'nullable|string',
            'author_id' => 'required|exists:authors,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $news->update($validated);
        $news->tags()->sync($request->tags);

        return response()->json($news->load('tags', 'author'));
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        return response()->json(['message' => 'News deleted successfully']);
    }
}
