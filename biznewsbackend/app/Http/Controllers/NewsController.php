<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with(['author', 'tags'])
            ->where('is_published', true) // Only fetch published news
            ->get();
        return response()->json($news);
    }
    public function All()
    {
        $news = News::with(['author', 'tags'])
            ->get();
        return response()->json($news);
    }

    public function show($id)
    {
        $news = News::with(['author', 'tags'])->findOrFail($id);

        // Increment the views count
        $news->increment('views');

        return response()->json($news);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg',  // Validate file type
            'category' => 'nullable|string',
            'authorId' => 'required|exists:authors,id',  // Validate author ID exists
            'tags' => 'nullable|string',  // Validate tags as a string (comma-separated)
        ]);

        // Handle image upload
        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('images', 'public')  // Store in 'public/images'
            : null;

        // Create the news item
        $news = News::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category' => $validated['category'],
            'author_id' => $validated['authorId'],
            'image' => $imagePath,
        ]);

        // Process tags
        if (!empty($validated['tags'])) {
            // Split the comma-separated tags into an array
            $tagsArray = array_map('trim', explode(',', $validated['tags']));

            $tagIds = collect($tagsArray)->map(function ($tagName) {
                // Find or create each tag and return its ID
                return Tag::firstOrCreate(
                    ['name' => $tagName],
                    ['created_at' => now(), 'updated_at' => now()]
                )->id;
            })->toArray();

            // Sync tags with the news
            $news->tags()->sync($tagIds);
        }

        return response()->json($news->load('tags', 'author'));
    }



    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate file type and size
            'category' => 'nullable|string',
            'authorId' => 'required|exists:authors,id', // Validate author ID exists
            'tags' => 'nullable|string',  // Validate tags as a string (comma-separated)

        ]);

        // Handle image upload if a new file is provided
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        // Update the news item
        $news->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $validated['image'] ?? $news->image, // Keep existing image if none is provided
            'category' => $validated['category'],
            'author_id' => $validated['authorId'],
        ]);

        // Handle tags
        if (!empty($validated['tags'])) {
            $tagIds = collect($validated['tags'])->map(function ($tagName) {
                return Tag::firstOrCreate(
                    ['name' => $tagName],
                    ['created_at' => now(), 'updated_at' => now()]
                )->id;
            })->toArray();

            // Sync tags with the news
            $news->tags()->sync($tagIds);
        } else {
            $news->tags()->detach(); // Remove all tags if none are provided
        }

        return response()->json($news->load('tags', 'author'));
    }



    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        return response()->json(['message' => 'News deleted successfully']);
    }

    public function addHeart(Request $request, $id)
    {
        $news = News::findOrFail($id);
        $news->increment('heart_counts', 1);
        return response()->json(['message' => 'Heart count updated successfully', 'heart_counts' => $news->heart_counts]);
    }

    public function publish($id)
    {
        // Find the news item by ID
        $news = News::findOrFail($id);

        // Toggle the `is_published` status
        $news->is_published = !$news->is_published;

        // Optionally set `published_at` date when publishing
        if ($news->is_published) {
            $news->published_at = now();
        } else {
            $news->published_at = null;
        }

        // Save the updated status
        $news->save();

        // Return the updated news item as a response
        return response()->json([
            'message' => $news->is_published ? 'News published successfully' : 'News unpublished successfully',
            'news' => $news,
        ]);
    }
}
