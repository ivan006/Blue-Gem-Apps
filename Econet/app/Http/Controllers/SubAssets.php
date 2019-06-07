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
      if (1==1) {
        // this work work as func_get_args() only expected the url
        $SubAssetURL = SubAssetsM::SubAssetURL(func_get_args()[0]);
        // this work work as func_get_args() only expected the url

        $s = "/";
        $filename =  $request->get('file');
        $file =  $SubAssetURL.$s.$filename;
        // echo file_get_contents($file);

        $contents =  $request->get('contents');
        file_put_contents($file,$contents);
      }



      if (1==1) {
        $SubAssetDeepRead = SubAssetsM::SubAssetDeepRead($a,$b);

        $EPgCont =  json_decode($request->get('smart'));
        SubAssetsM::EPgCont($SubAssetURL, $EPgCont);


      }

      $allURLs = SubAssetsM::allURLs(func_get_args()[0]);

      return redirect($allURLs['sub_assets_update']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(){

      $SubAssetsDeepList = SubAssetsM::SubAssetsDeepList(func_get_args());

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

      $SubAssetsDeepList = SubAssetsM::SubAssetsDeepList(func_get_args()[0]);

      $SubAssetDeepRead = SubAssetsM::SubAssetDeepRead(func_get_args()[0]);

      $allURLs = SubAssetsM::allURLs(func_get_args()[0]);


      return view('edit', compact('SubAssetDeepRead','SubAssetsDeepList', 'a', 'b', 'allURLs'));
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
