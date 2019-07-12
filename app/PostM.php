<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\NetworkM;
use App\PostM;
use App\SmartDataItemM;
use App\SmartDataGroupM;



class PostM extends Model
{


  // needed to make  link in subposts list and to use with "storeAs" function start
  public static function ShowID(){

    // $root= NetworkM::ShowBaseLocation();
    $arguments = func_get_args()[0];
    // var_dump($arguments);
    // array_shift($arguments);
    // $VPgLoc = '';


    foreach ($arguments as $key => $value) {
      if (isset($VPgLoc)) {
        $VPgLoc .= "/".$value;
      } else {
        $VPgLoc = $value;
      }
    }


    return $VPgLoc;

  }
  // needed to make  link in subposts list and to use with "storeAs" function end
  public static function ShowLocation() {

    // dd(func_get_args()[0]);
    // echo NetworkM::ShowBaseLocation().PostM::ShowID(func_get_args()[0]);

    $arguments = func_get_args()[0];
    // array_shift($arguments);
    // var_dump($arguments);
    if (!empty($arguments)) {

      return  NetworkM::ShowBaseLocation().PostM::ShowID(func_get_args()[0]);
    } else {
      // return  NetworkM::ShowBaseLocation().NetworkM::ShowID(func_get_args()[0]);
      return "now what";
    }

  }

  // needed for header call starts
  public static function ShowBaseID() {
    $arguments = func_get_args()[0][0];

    return $arguments;
  }
  public static function ShowBaseIDPlusBaseLocation() {
    return NetworkM::ShowBaseLocation().PostM::ShowBaseID(func_get_args()[0]);
  }
  // needed for header call end

  public static function ShowActions() {

    if (!empty(func_get_args()[0])) {
      // dd(func_get_args());

      $ShowID = PostM::ShowID(func_get_args()[0]);
      $allURLs['sub_post_read'] =   route('Post.show',$ShowID);
      $allURLs['sub_post_edit'] = route('Post.edit',$ShowID);

      // $allURLs['sub_post_update'] = route('Post.update',$ShowID.$ShowID);
      $allURLs['sub_post_destroy'] = route('Post.destroy',$ShowID);
      $allURLs['sub_post_store'] = route('Post.store',$ShowID);
      $allURLs['sub_post_create'] = route('Post.create');
      // $allURLs['sub_post_index'] = route('Post.index',$ShowID.$ShowID);



      $allURLs['post_create'] = route('Post.create');
      $allURLs['post_index'] = route('Post.index');
    } else {
      $allURLs['sub_post_read'] =   " ";
      $allURLs['sub_post_edit'] = " ";

      $allURLs['sub_post_destroy'] =  " ";
      $allURLs['sub_post_create'] =  " ";


    }

    // dd($allURLs);
    return $allURLs;
  }
  public static function ShowSubPost() {



    if(!function_exists('App\ShowSubPostHelper')){

      function ShowSubPostHelper($ShowLocation,$staticdir,$ShowID) {
        $result = array();
        // dd ($ShowLocation);
        $dataNameList = scandir($ShowLocation);

        $url = str_replace($staticdir, "", $ShowLocation);
        $result["url"] = route("Post.show")."/".$ShowID.$url;
        foreach ($dataNameList as $key => $value) {
          if (!in_array($value,array(".","..")))  {
            $dataLocation = $ShowLocation . "/" . $value;
            if (is_dir($dataLocation) and basename($dataLocation) !== "smart"){
              $subDataNameList = scandir($dataLocation);
              $blackList = array(".","..","smart","rich.txt");
              $whiteList = array_diff_key($subDataNameList,$blackList);
              if (!empty($whiteList)) {
                $result[$value] = ShowSubPostHelper($dataLocation,$staticdir,$ShowID);
                // $url = str_replace($staticdir."/", "", $dataLocation);
                // $result[$value]["url"] = route("Post.show")."/".$ShowID."/".$url;
              } else {
                $url = str_replace($staticdir, "", $dataLocation);
                $result[$value] = route("Post.show")."/".$ShowID.$url;
              }
            }
          }
        }
        return $result;
      }
    }


    $ShowID = PostM::ShowID(func_get_args()[0]);
    $ShowLocation = NetworkM::ShowLocation($ShowID);
    $staticdir = NetworkM::ShowLocation($ShowID);

    $result[$ShowID] = ShowSubPostHelper($ShowLocation,$staticdir,$ShowID);


    return $result;
  }

  public static function Show() {
  }
  public static function ShowAllSmartData() {
    if(!function_exists('App\ShowAllSmartDataHelper')){
      function ShowAllSmartDataHelper($ShowLocation) {
        $result = array();
        $shallowList = scandir($ShowLocation);
        foreach ($shallowList as $key => $value) {
          if (!in_array($value,array(".","..")))  {
            $DataLocation = $ShowLocation . "/" . $value;
            if (is_dir($DataLocation)){
              $result[$value] = ShowAllSmartDataHelper($DataLocation);
            } else {
              $result[$value] = file_get_contents($DataLocation);
            }
          }
        }
        return  $result;
      }
    }
    $ShowLocation = PostM::ShowLocation(func_get_args()[0])."/smart";

    if (is_dir($ShowLocation)) {
      return  ShowAllSmartDataHelper($ShowLocation);
    }
  }

  public static function Store($arguments, $request) {

    function StoreRichData($ShowLocation, $request){


      $filename =  "rich.txt";
      $file =  $ShowLocation."/".$filename;
      // echo file_get_contents($file);

      $contents =  $request->get('contents');
      file_put_contents($file,$contents);


    }
    function StoreSmartDataFromFile($arguments, $request) {




      $ShowID = PostM::ShowID($arguments);


      $request->zip_file->storeAs("public/".$ShowID."/smart", $request->zip_file->getClientOriginalName());
      // $path = "Econet/".NetworkM::ShowBaseLocation().$ShowID."/".$request->zip_file->getClientOriginalName();
      // $path = NetworkM::ShowBaseLocation().$ShowID."/".$request->zip_file->getClientOriginalName();
      $path = NetworkM::ShowBaseLocation().$ShowID."/smart"."/".$request->zip_file->getClientOriginalName();
      // dd($path);
      // $Path = public_path($ShowID);


      $zipper = new \Chumper\Zipper\Zipper;
      $zipper->make($path)->extractTo(NetworkM::ShowBaseLocation().$ShowID."/smart"."/");
      $zipper->close();
      unlink(NetworkM::ShowBaseLocation().$ShowID."/smart"."/".$request->zip_file->getClientOriginalName());


    }



    if (null !== $request->file('zip_file')) {
      StoreSmartDataFromFile($arguments, $request);
    }

    $ShowLocation = PostM::ShowLocation($arguments);
    $EPgCont =  json_decode($request->get('smart'), true);
    SmartDataGroupM::Store($ShowLocation, $EPgCont);


    StoreRichData($ShowLocation, $request);


  }



}
