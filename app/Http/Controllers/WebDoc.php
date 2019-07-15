<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NetworkM;
use App\WebDocM;
use App\MetadataM;
use App\RichDataM;

use App\SmartDataItemM;
use App\SmartDataArrayM;





class WebDoc extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $allURLs = WebDocM::ShowActions(func_get_args());

      $WebDocList = NetworkM::ShowWebDoc();


      // echo Route::getCurrentRoute()->getPath();

      return view('browse', compact('WebDocList', 'allURLs'));
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
      WebDocM::Store($arguments, $request);




      $allURLs = WebDocM::ShowActions($arguments);
      // dd($allURLs['sub_webdoc_edit']);


      return redirect($allURLs['sub_webdoc_edit']);
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


      // $SubWebDocDeepList = WebDocM::ShowSubWebDoc(func_get_args());
      // dd($SubWebDocDeepList);
      // $ShowAllSmartData = WebDocM::ShowAllSmartData(func_get_args());
      // $func_get_args =func_get_args();
      // $VSiteHeader = WebDocM::ShowAllSmartDataHelper(NetworkM::ShowLocation(end($func_get_args)));


      $allURLs = WebDocM::ShowActions(func_get_args());

       $ShowBaseIDPlusBaseLocation = WebDocM::ShowBaseIDPlusBaseLocation(func_get_args());
       $RichDataShow = RichDataM::Show(func_get_args());


      return view('view', compact('allURLs', 'ShowBaseIDPlusBaseLocation', 'RichDataShow'));
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

      // $SubWebDocDeepList = WebDocM::ShowSubWebDoc(func_get_args());

      $ShowAllSmartData = WebDocM::ShowAllSmartData(func_get_args());


      $allURLs = WebDocM::ShowActions(func_get_args());

      $RichDataShow = RichDataM::Show(func_get_args());


      return view('edit', compact('ShowAllSmartData', 'allURLs', 'RichDataShow'));
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
