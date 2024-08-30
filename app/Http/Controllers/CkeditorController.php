<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CkeditorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    
    }
    public function upload(Request $request){
        // $originName = $request->file('upload')->getClientOriginalName();
        // $fileName = pathinfo($originName,PATHINFO_FILENAME);
        // $extention = $request->file('upload')->getClientOriginalExtension();
        // $fileName  = $fileName.'_'.time().'.'.$extention;

        // $request->file('upload')->move(public_path('ckeditorUpload'),$fileName);
        // $fileName = $request->file('upload')->store('ckeditorUpload');
        // $CKeditorFuncNum = $request->input('CKEditorFuncNum');  
        // $url = asset($fileName);

        $file = $request->file('upload');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('uploads/ckeditorUpload'), $fileName);
        $url = asset('uploads/ckeditorUpload/' . $fileName);
        
        // $msg = 'Image upload successfully ! ';
        // $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKeditorFuncNum,'$url','$msg')</script>";

        // @header('Content-type:text/html;charset=utf-8');

        // echo $response;

        return response()->json(['filename'=>$fileName,'uploaded'=>1,'url'=>$url]);
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
    }
}
