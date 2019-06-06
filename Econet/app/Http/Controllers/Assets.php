<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubAssetsM;
use App\AssetsM;
// use Illuminate\Routing\Redirector;
// use Illuminate\Routing\Facades\Route;

class Assets extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $AssetsList = AssetsM::AssetsList();

      $AssetURLs = SubAssetsM::AssetURLs();

      // echo Route::getCurrentRoute()->getPath();

      return view('browse', compact('AssetsList','AssetURLs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('WriteAsset', compact('allURLs'));
        return view('WriteAsset');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      AssetsM::store($request);
      return redirect( route('show', $request->get('name')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


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
