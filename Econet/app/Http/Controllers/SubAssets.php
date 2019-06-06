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
    public function store(Request $request, $a=null, $b=null)
    {
      if (1==1) {

        $SubAssetURL = SubAssetsM::SubAssetURL($a,$b);

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

      $allURLs = SubAssetsM::allURLs($a,$b);

      return redirect($allURLs['sub_assets_update']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($a=null, $b=null){

      $SubAssetsDeepList = SubAssetsM::SubAssetsDeepList($a,$b);

      $SubAssetDeepRead = SubAssetsM::SubAssetDeepRead($a,$b);

      $VSiteHeader = SubAssetsM::deepRead(AssetsM::AssetURL($b));
      $VSiteHeader = $VSiteHeader['header.html'];

      $allURLs = SubAssetsM::allURLs($a,$b);



      return view('view', compact('SubAssetDeepRead','SubAssetsDeepList', 'a', 'b', 'VSiteHeader', 'allURLs'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($a=null, $b=null){

      $SubAssetsDeepList = SubAssetsM::SubAssetsDeepList($a,$b);

      $SubAssetDeepRead = SubAssetsM::SubAssetDeepRead($a,$b);

      $allURLs = SubAssetsM::allURLs($a,$b);


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
