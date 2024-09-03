<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $story_id)
    {
        //
        $story = \App\Models\Story::find($story_id);

        return view("admin.story.chapter.create_chapter", [
            'story' => $story
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|max:250',
            'content' => 'required',
            'story_id' => 'required',
        ]);

        Chapter::create([
            'title' => $request->title,
            'content' => $request->content,
            'story_id' => $request->story_id,
        ]);
        return redirect()->back()->with('status', 'Chapter was added !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $chapter = Chapter::find($id);
        return view('admin.story.chapter.edit_chapter',[
            'chapter' => $chapter
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'title' => 'required|max:250',
            'content' => 'required',
            'story_id' => 'required',
        ]);
        $chapter = Chapter::find($id);

        $chapter->update([
            'title' => $request->title,
            'content' => $request->content,
            'story_id' => $request->story_id,
        ]);
        return redirect()->back()->with('status', 'Chapter was added !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Chapter::find($id)->delete();

        return response()->json(['result' => ' Chapter is deleted !']);
    }
}
