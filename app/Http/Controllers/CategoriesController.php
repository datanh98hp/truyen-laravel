<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $listSalePrd = Products::where('sale_off', '>', 0)->orderBy('id', 'desc')->get();
        $categoriesList = Categories::all();
        return view('admin.categories', ['categoriesList' => $categoriesList, 'listSalePrd' => $listSalePrd]);
    }
    public function getProductById($category_id)
    {
        $listSalePrd = Products::where('sale_off', '>', '0')->orderBy('id', 'desc')->get();
        $latestProduct = Products::orderBy('created_at', 'desc')->take(6)->get();
        $products = Categories::find($category_id)->products()->paginate(12);
        $category_t = Categories::find($category_id);
        return view('shop-category', ['products' => $products, 'listSalePrd' => $listSalePrd, 'latestProduct' => $latestProduct, 'category_t' => $category_t]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'status' => 'required',
        ]);

        $new = Categories::create([
            'title' => $request->title,
            'class' => $request->class,
            'status' => $request->status,
        ]);

        if ($request->hasFile('img')) {

            $file = $request->file('img');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads/story'), $fileName);
            $url = asset('uploads/story/' . $fileName);
            $new->update([
                'img' => $url
            ]);
        }

        return back()->with('status', 'Insert OK');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //




    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $request->validate([
            'title' => 'required|max:50',
            'status' => 'required',
        ]);

        Categories::where('id', $id)->update([
            'title' => $request->title,
            'status' => $request->status
        ]);
        // delete old image
        $itm = Categories::find($id);
        if (File::exists($itm->img)) {
            File::delete($itm->img);
        }
        //Storage::delete('app/'.$itm->img);
        //
        if ($request->hasFile('img')) {

            $path = $request->file('img')->store('images');

            Categories::where('id', $id)->update([
                'img' => $path
            ]);
        }

        return back()->with('status', 'Updated OK');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function multiDdel(Request $request)
    {

        $arrId = $request->arrId;
        Categories::destroy($arrId);

        return response()->json(['result' => $request->all()]);
    }

    public function delete(Request $request)
    {

        // $id = $request->id;
        // Categories::destroy( $id );

        // return response()->json(['result'=>$request->all()]);

    }
    public function destroy($id)
    {
        //

    }
}
