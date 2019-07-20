<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NetworkM;
use App\PostM;
use App\MetadataM;
use App\RichDataM;

use App\SmartDataItemM;
use App\SmartDataArrayM;





class Post extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $allURLs = PostM::ShowActions(func_get_args());

      $PostList = NetworkM::ShowPost();


      // echo Route::getCurrentRoute()->getPath();

      return view('browse', compact('PostList', 'allURLs'));
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
      PostM::Store($arguments, $request);




      $allURLs = PostM::ShowActions($arguments);
      // dd($allURLs['sub_post_edit']);


      return redirect($allURLs['sub_post_edit']);
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


      // $SubPostDeepList = PostM::ShowSubPost(func_get_args());
      // dd($SubPostDeepList);
      // $ShowAllDeepSmartData = PostM::ShowAllDeepSmartData(func_get_args()[0]);
      // $func_get_args =func_get_args();
      // $VSiteHeader = PostM::ShowAllDeepSmartDataHelper(NetworkM::ShowLocation(end($func_get_args)));


      $allURLs = PostM::ShowActions(func_get_args());

       $ShowBaseIDPlusBaseLocation = PostM::ShowBaseIDPlusBaseLocation(func_get_args());
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

      // $SubPostDeepList = PostM::ShowSubPost(func_get_args());
      // dd(func_get_args()[0]);
      $ShowID = PostM::ShowID(func_get_args());
      $ShowAllDeepSmartData = PostM::ShowAllDeepSmartData($ShowID);
      // $ShowAllDeepSmartData = PostM::ShowAllDeepSmartData("hey - Copy/smart/smartdataarray");
      // dd ($ShowAllDeepSmartData);
      $ShowAllShallowSmartData = PostM::ShowAllShallowSmartData(func_get_args());
      $SmartDataItemM_ShowActions = SmartDataItemM::ShowActions();
      $SmartDataItemM_ShowAttributeTypes = SmartDataItemM::ShowAttributeTypes();

      $allURLs = PostM::ShowActions(func_get_args());

      $RichDataShow = RichDataM::Show(func_get_args());
      $SmartDataArrayShowBaseLocation = SmartDataArrayM::ShowBaseLocation();

      return view('edit', compact(
        'ShowAllDeepSmartData',
        'allURLs',
        'RichDataShow',
        'ShowAllShallowSmartData',
        'SmartDataItemM_ShowActions',
        'SmartDataItemM_ShowAttributeTypes',
        'SmartDataArrayShowBaseLocation'
      ));
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
