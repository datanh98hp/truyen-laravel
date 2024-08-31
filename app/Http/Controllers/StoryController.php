<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Chapter;
use App\Models\Story;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $stories = Story::orderBy('id', 'desc')->get();
        foreach ($stories as $story) {
            $cate = $story->category;
            $story->category = $cate;
        }
        return view("admin.story.index",[
            'stories' => $stories
        ]);
    }
    public function getall()
    {
        $stories = Story::orderBy('id', 'desc')->get();
        foreach ($stories as $story) {
            $cate = $story->category;
            $story->category = $cate;
        }
        return response()->json(['result' => $stories]);
    }

    public function filterByCategory(Request $request)
    {
        //
        $data = [];
        $categories = Categories::query()->orderBy('id', 'desc')->get();
        if ($request->category !== null) {
            $stories = Story::where('category_id', $request->category)
                ->orderBy('id', 'desc')->get();
            foreach ($stories as $story) {
                $cate = $story->category;
                $story->category = $cate;
            }
            return response()->json(['result' => $stories]);
        } else {
            $stories = Story::orderBy('id', 'desc')->get();
            foreach ($stories as $story) {
                $cate = $story->category;
                $story->category = $cate;
            }
            return response()->json(['result' => $stories]);
        }
        // return $request->all();
    }

    public function filterByNumberDay(Request $request)
    {
        // $categories = Categories::orderBy('id', 'desc')->get();
        $now = date('Y-m-d H:i:s');
        $stories = Story::whereBetween('created_at', [$request->day, $now])
            ->orderBy('id', 'desc')->get();
        foreach ($stories as $story) {
            $cate = $story->category;
            $story->category = $cate;
        }


        return response()->json(['result' => $stories]);
       
    }

    public function filterByTime(Request $request)
    {
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $today = date('Y-m-d');
        if ($startDate == $endDate || $startDate == $today) {
            $stories = Story::whereDate('created_at', $startDate)->orderBy('id', 'desc')->get();
            foreach ($stories as $story) {
                $cate = $story->category;
                $story->category = $cate;
            }
            return response()->json(['result' => $stories]);
        } else {
            $stories = Story::whereBetween('created_at', [$startDate, $endDate])
                ->orderBy('id', 'desc')->get();
            foreach ($stories as $story) {
                $cate = $story->category;
                $story->category = $cate;
            }
            return response()->json(['result' => $stories]);    
        }

        
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|max:50',
            'thumImg' => 'required',
            'category_id' => 'required',
        ]);
// 
        $file = $request->file('thumImg');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('uploads/story'), $fileName);
        $url = asset('uploads/story/' . $fileName);
        
//  
        Story::create([
            'title' => $request->title,
            'thumImg' => $url,
            'category_id' => $request->category_id,
            'slug'=> $request->slug,
            'tag'=>$request->tag,
            'des'=>$request->des
        ]);
        return redirect()->back()->with('status', 'Story was added !');
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'title' => 'required|max:50',
            // 'thumImg' => 'required',
            'category_id' => 'required',
        ]);
        $story = Story::find($id);
        // 
        if ($request->hasFile('thumImg')) {
            $file = $request->file('thumImg');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads/story'), $fileName);
            $url = asset('uploads/story/' . $fileName);

           
            $story->update([
                'title' => $request->title,
                'thumImg' => $url,
                'category_id' => $request->category_id,
                'slug' => $request->slug,
                'tag' => $request->tag,
                'des' => $request->des
            ]);
        }else{
            $story->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'slug' => $request->slug,
                'tag' => $request->tag,
                'des' => $request->des
            ]);
        }
       
        //  
        
        return redirect()->back()->with('status', 'Story was updated !');
    }

    public function multiDdel(Request $request)
    {

        $arrId = $request->arrId;

        // remove img
        $list = Story::whereIn('id', $arrId)->get();

        foreach ($list as $item) {
            if (File::exists($item->thumImg)) {
                File::delete($item->thumImg);
            }
        }

        Story::whereIn('id', $arrId)->delete();

        return response()->json(['result' => $request->all()]);
        //return  $list;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chapters = Chapter::where('story_id', $id)->get();
        foreach ($chapters as $chapter) {
            $chapter->delete();
        }
        //
        $story = Story::find($id);
        $story->delete();
        return response()->json(['result' => 'Deleted !']);
    }
}
