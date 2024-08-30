<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\ImageProducts;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Categories::orderBy('id', 'desc')->get();
        $products   = Products::orderBy('id', 'desc')->get();
        $bestVoteProduct = Products::orderBy('vote', 'desc')->take(6)->get(); // 6 element
        return view('admin.ListProducts', [
            'categories' => $categories, 
            'products' => $products,
            'bestVoteProduct'=>$bestVoteProduct
        ]);
    }

    private function getBestVoteProduct()
    {
        #all product
        $all =  Products::all();
        $maxVal = 0;

        foreach ($all as $item) {
            if ($item->vote > $maxVal) {
                $maxVal = $item->vote;
            }
        }
    }
    public function getall()
    {
        $products   = Products::orderBy('id', 'desc')->get();

        $data = [];

        foreach ($products as $product) {
            $image = $product->images;
            array_push($data, ['product' => $product, 'imgs' => $image]);
        }

        return response()->json(['result' => $data]);
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
        //

        $request->validate([
            'name' => 'required|max:50',
            'category_id' => 'required',
            'price' => 'required',
            'quanlity' => 'required',
        ]);


        $new = Products::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'sale_off'=>$request->sale_off,
            'quanlity' => $request->quanlity,
            'tag' => empty($request->tag) ? "No tag" : $request->tag,
            'des' => empty($request->des) ? "No description" : $request->des,
            'slug' => empty($request->slug) ? "No slug" : $request->slug

        ]);


        foreach ($request->file('img') as $image) {

            $file = $request->file('img');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads/product'), $fileName);
            $url = asset('uploads/product/' . $fileName);

            ImageProducts::create([
                'products_id' => $new->id,
                'slug' => $new->slug,
                'tag' => $new->tag,
                'img' => $url
            ]);
        }

        return back()->with('status', 'Create OK');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function filterByCategory(Request $request)
    {
        //
        $categories = Categories::orderBy('id', 'desc')->get();
        if ($request->category !== null) {
            $products   = Products::where('category_id', $request->category)
                ->orderBy('id', 'desc')->get();
        } else {
            $products   = Products::orderBy('id', 'desc')->get();
        }
        $data = [];

        foreach ($products as $product) {
            $image = $product->images;
            array_push($data, ['product' => $product, 'imgs' => $image]);
        }

        return response()->json(['result' => $data]);

        // return $request->all();
    }
    public function filterByNumberDay(Request $request)
    {
        //
        $categories = Categories::orderBy('id', 'desc')->get();
        $now = date('Y-m-d H:i:s');
        $products   = Products::whereBetween('created_at', [$request->day, $now])
            ->orderBy('id', 'desc')->get();

        $data = [];

        foreach ($products as $product) {
            $image = $product->images;
            array_push($data, ['product' => $product, 'imgs' => $image]);
        }

        return response()->json(['result' => $data]);
        //return response()->json(['result'=>$request->all()]);
    }

    public function filterByTime(Request $request)
    {
        $startDate = $request->startDate;
        $endDate   = $request->endDate;
        $today     = date('Y-m-d');
        if ($startDate == $endDate || $startDate == $today) {
            $products   = Products::whereDate('created_at', $startDate)->orderBy('id', 'desc')->get();
        } else {
            $products   = Products::whereBetween('created_at', [$startDate, $endDate])
                ->orderBy('id', 'desc')->get();
        }

        $data = [];

        foreach ($products as $product) {
            $image = $product->images;
            array_push($data, ['product' => $product, 'imgs' => $image]);
        }

        return response()->json(['result' => $data]);
    }
    public function show($id)
    {   
        //
        $product = Products::find($id);
        $relatedProduct = Products::where('category_id',$product->category_id)->orderBy('id','desc')->get();
        return view('product-detail',['product'=>$product,'relatedProduct'=>$relatedProduct]);
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
            'name' => 'required|max:50',
            'category_id' => 'required',
            'price' => 'required',
            'quanlity' => 'required',
        ]);


        Products::where('id', $id)->first()->update([

            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'sale_off'=>$request->sale_off,
            'quanlity' => $request->quanlity,
            'tag' => empty($request->tag) ? "No tag" : $request->tag,
            'des' => empty($request->des) ? "No description" : $request->des,
            'slug' => empty($request->slug) ? "No slug" : $request->slug

        ]);


        if ($request->hasFile('img')) {

            // remove old image
            $listImg = ImageProducts::where('products_id', $id)->get();

            foreach ($listImg as $item) {
                if (File::exists($item->img)) {
                    File::delete($item->img);
                }
            }
            ///
            ImageProducts::where('products_id', $id)->delete();
            //////

            foreach ($request->file('img') as $image) {

                $path =  $image->store('productImages');

                ImageProducts::create([
                    'products_id' => $id,
                    'slug' => empty($request->slug) ? "No slug" : $request->slug,
                    'tag' => empty($request->tag) ? "No tag" : $request->tag,
                    'img' => $path
                ]);
            }
        }

        return back()->with('status', 'Update  OK');

        //return $request->all();  
    }
    public function multiDdel(Request $request)
    {

        $arrId = $request->arrId;

        // remove img
        $list = ImageProducts::whereIn('products_id', $arrId)->get();

        foreach ($list as $item) {
            if (File::exists($item->img)) {
                File::delete($item->img);
            }
        }

        ImageProducts::whereIn('products_id', $arrId)->delete();


        Products::destroy($arrId);

        return response()->json(['result' => $request->all()]);
        //return  $list;
    }

    function updateImg(Request $request, $id)
    {

        if ($request->hasFile('inputFile')) {
            $img = ImageProducts::find($id);

            if (File::exists($img->img)) {
                File::delete($img->img);
            }

            $path = $request->file('inputFile')->store('productImages');

            $img->img = $path;
            $img->save();
        }
        return back()->with('status', 'Image was update !');
        // return $request->all();
    }
    function addImg(Request $request, $product_id)
    {

        if ($request->hasFile('inputFile')) {

            $path = $request->file('inputFile')->store('productImages');

            ImageProducts::create([
                'products_id' => $product_id,
                'slug' => empty($request->slug) ? "No slug" : $request->slug,
                'tag' => empty($request->tag) ? "No tag" : $request->tag,
                'img' => $path
            ]);
        }
        return back()->with('status', 'Image was added !');
        // return $request->all();
    }

    function delImg($id)
    {
        $img = ImageProducts::find($id);
        if (File::exists($img->img)) {
            File::delete($img->img);
        }
        $img->delete();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        // remove img
        $list = ImageProducts::where('products_id', $id)->get();

        foreach ($list as $item) {
            if (File::exists($item->img)) {
                File::delete($item->img);
            }
        }


        ImageProducts::where('products_id', $id)->delete();

        Products::destroy($id);

        return response()->json(['result' => 'Deleted !']);
    }
}
