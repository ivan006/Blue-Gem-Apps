<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubAssetsM;
use App\AssetsM;

class SubAssets extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $allURLs = SubAssetsM::allURLs(func_get_args());

      $AssetsList = AssetsM::AssetsList();


      // echo Route::getCurrentRoute()->getPath();

      return view('browse', compact('AssetsList', 'allURLs'));
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
      $arguments = func_get_args();
      array_shift($arguments);
      array_shift($arguments);
      if (1==1) {
        // this work work as func_get_args() only expected the url
        $SubAssetURL = SubAssetsM::SubAssetURL($arguments);
        // this work work as func_get_args() only expected the url


        $filename =  $request->get('file');
        $file =  $SubAssetURL.$filename;
        // echo file_get_contents($file);

        $contents =  $request->get('contents');
        file_put_contents($file,$contents);
      }



      if (1==1) {
        $SubAssetDeepRead = SubAssetsM::SubAssetDeepRead($arguments);

        $EPgCont =  json_decode($request->get('smart'));

        SubAssetsM::EPgCont($SubAssetURL, $EPgCont);


      }

      $allURLs = SubAssetsM::allURLs($arguments);

      return redirect($allURLs['sub_assets_edit']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(){
      $arguments = func_get_args();
      array_shift($arguments);
      array_shift($arguments);

      $SubAssetsDeepList = SubAssetsM::SubAssetsDeepList(func_get_args());
      // dd($SubAssetsDeepList);
      $SubAssetDeepRead = SubAssetsM::SubAssetDeepRead(func_get_args());
      // $func_get_args =func_get_args();
      // $VSiteHeader = SubAssetsM::deepRead(AssetsM::AssetURL(end($func_get_args)));
      // $VSiteHeader = $VSiteHeader['header.html'];
      $VSiteHeader ="";

      $allURLs = SubAssetsM::allURLs(func_get_args());




      return view('view', compact('SubAssetDeepRead','SubAssetsDeepList', 'VSiteHeader', 'allURLs'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(){
      $arguments = func_get_args();

      array_shift($arguments);
      array_shift($arguments);

      $SubAssetsDeepList = SubAssetsM::SubAssetsDeepList(func_get_args());

      $SubAssetDeepRead = SubAssetsM::SubAssetDeepRead(func_get_args());


      $allURLs = SubAssetsM::allURLs(func_get_args());




      return view('edit', compact('SubAssetDeepRead','SubAssetsDeepList', 'allURLs'));
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
