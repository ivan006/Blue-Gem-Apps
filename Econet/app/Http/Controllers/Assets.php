<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssetsM;


class Assets extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $allURLs = AssetsM::allURLs(func_get_args());

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
      if (1==1) {
        $SubAssetURL = AssetsM::SubAssetURL($arguments);


        $filename =  $request->get('file');
        $file =  $SubAssetURL."/".$filename;
        // echo file_get_contents($file);

        $contents =  $request->get('contents');
        file_put_contents($file,$contents);
      }



      if (1==1) {
        $SubAssetDeepRead = AssetsM::SubAssetDeepRead($arguments);

        $EPgCont =  json_decode($request->get('smart'), true);

        AssetsM::StoreSubAsset($SubAssetURL, $EPgCont);


      }
      if (null !== $request->file('zip_file')) {

        echo AssetsM::upload($arguments, $request);
      }

      $allURLs = AssetsM::allURLs($arguments);
      // dd($allURLs['sub_assets_edit']);

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

      $SubAssetsDeepList = AssetsM::SubAssetsDeepList(func_get_args());
      // dd($SubAssetsDeepList);
      $SubAssetDeepRead = AssetsM::SubAssetDeepRead(func_get_args());
      // $func_get_args =func_get_args();
      // $VSiteHeader = AssetsM::deepRead(AssetsM::AssetURL(end($func_get_args)));


      $allURLs = AssetsM::allURLs(func_get_args());




      return view('view', compact('SubAssetDeepRead','SubAssetsDeepList', 'allURLs'));
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

      $SubAssetsDeepList = AssetsM::SubAssetsDeepList(func_get_args());

      $SubAssetDeepRead = AssetsM::SubAssetDeepRead(func_get_args());


      $allURLs = AssetsM::allURLs(func_get_args());

    


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
