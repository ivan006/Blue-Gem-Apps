<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\NetworkM;
use App\PostM;
use App\SmartDataM;





class PostM extends Model
{
  public static function ShowID(){

    // $root= PostM::ShowBaseLocation();
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
  public static function ShowBaseLocation() {
    return "storage/app/public/";
  }
  public static function ShowBaseID() {
      $arguments = func_get_args()[0][0];

    return $arguments;
  }
  public static function ShowBaseIDPlusBaseLocation() {
    return PostM::ShowBaseLocation().PostM::ShowBaseID(func_get_args()[0]);
  }
  public static function ShowLocation() {

    // dd(func_get_args()[0]);
    // echo PostM::ShowBaseLocation().PostM::ShowID(func_get_args()[0]);

    $arguments = func_get_args()[0];
    // array_shift($arguments);
    // var_dump($arguments);
    if (!empty($arguments)) {

      return  PostM::ShowBaseLocation().PostM::ShowID(func_get_args()[0]);
    } else {
      // return  PostM::ShowBaseLocation().NetworkM::ShowID(func_get_args()[0]);
      return "now what";
    }

  }

  public static function ShowActions() {

    if (!empty(func_get_args()[0])) {


      $SubAssetURLSuffix = PostM::ShowID(func_get_args()[0]);
      $allURLs['sub_post_read'] =   route('Post.show',$SubAssetURLSuffix);
      $allURLs['sub_post_edit'] = route('Post.edit',$SubAssetURLSuffix);

      // $allURLs['sub_post_update'] = route('Post.update',$SubassetURLSuffix.$SubAssetURLSuffix);
      $allURLs['sub_post_destroy'] = route('Post.destroy',$SubAssetURLSuffix);
      $allURLs['sub_post_store'] = route('Post.store',$SubAssetURLSuffix);
      $allURLs['sub_post_create'] = route('Post.create');
      // $allURLs['sub_post_index'] = route('Post.index',$SubassetURLSuffix.$SubAssetURLSuffix);



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

  public static function ShowIndirectDataHelper($SubassetURL) {
    $result = array();
    $shallowList = scandir($SubassetURL);
    foreach ($shallowList as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $VPgContItemLoc = $SubassetURL . DIRECTORY_SEPARATOR . $value;
        if (is_dir($VPgContItemLoc)){
          $result[$value] = PostM::ShowIndirectDataHelper($VPgContItemLoc);
        } else {
          $result[$value] = file_get_contents($VPgContItemLoc);
        }
      }
    }
    return  $result;
  }
  public static function ShowIndirectData() {
    return  PostM::ShowIndirectDataHelper(PostM::ShowLocation(func_get_args()[0]));
  }

  public static function ShowIndirectSubPost() {
    // $arguments = func_get_args()[0];
    // array_shift($arguments);
    // dd(func_get_args()[0]);

    $SubassetURLSuffix = PostM::ShowID(func_get_args()[0]);
    $SubassetURL = NetworkM::ShowLocation($SubassetURLSuffix);
    $staticdir = NetworkM::ShowLocation($SubassetURLSuffix);
    // dd($staticdir);
    $result[$SubassetURLSuffix] = PostM::ShowIndirectSubPostHelper($SubassetURL,$staticdir,$SubassetURLSuffix);
    // dd($result);

    // $arguments = $request->route()->parameters();
    // // dd($arguments);
    // $SubassetURLSuffix = $arguments['a'];
    // $SubassetURL = NetworkM::ShowLocation($SubassetURLSuffix);
    // // dd($SubassetURL);
    // $VPgsLocs = PostM::ShowIndirectSubPostHelper($SubassetURL,$SubassetURL,$SubassetURLSuffix);
    // // dd($VPgsLocs);

    return $result;
  }
  public static function ShowIndirectSubPostHelper($SubassetURL,$staticdir,$SubassetURLSuffix) {
    $result = array();
    // dd ($SubassetURL);
    $dataNameList = scandir($SubassetURL);

    $url = str_replace($staticdir, "", $SubassetURL);
    $result["url"] = route("Post.show")."/".$SubassetURLSuffix.$url;
    foreach ($dataNameList as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $dataLocation = $SubassetURL . "/" . $value;
        if (is_dir($dataLocation) and basename($dataLocation) !== "smart"){
          $subDataNameList = scandir($dataLocation);
          $blackList = array(".","..","smart","rich.txt");
          $whiteList = array_diff_key($subDataNameList,$blackList);
          if (!empty($whiteList)) {
            $result[$value] = PostM::ShowIndirectSubPostHelper($dataLocation,$staticdir,$SubassetURLSuffix);
            // $url = str_replace($staticdir."/", "", $dataLocation);
            // $result[$value]["url"] = route("Post.show")."/".$SubassetURLSuffix."/".$url;
          } else {
            $url = str_replace($staticdir, "", $dataLocation);
            $result[$value] = route("Post.show")."/".$SubassetURLSuffix.$url;
          }
        }
      }
    }
    return $result;
  }

  public static function upload($arguments, $request) {



    $SubAssetURLSuffix = PostM::ShowID($arguments);
    $AssetAndSubAssetURLSuffix = $SubAssetURLSuffix;



    $request->zip_file->storeAs("public/".$AssetAndSubAssetURLSuffix."/smart", $request->zip_file->getClientOriginalName());
    // $path = "Econet/".PostM::ShowBaseLocation().$AssetAndSubAssetURLSuffix."/".$request->zip_file->getClientOriginalName();
    // $path = PostM::ShowBaseLocation().$AssetAndSubAssetURLSuffix."/".$request->zip_file->getClientOriginalName();
    $path = PostM::ShowBaseLocation().$AssetAndSubAssetURLSuffix."/smart"."/".$request->zip_file->getClientOriginalName();
    // dd($path);
    // $Path = public_path($AssetAndSubAssetURLSuffix);


    $zipper = new \Chumper\Zipper\Zipper;
    $zipper->make($path)->extractTo(PostM::ShowBaseLocation().$AssetAndSubAssetURLSuffix."/smart"."/");
    $zipper->close();
    unlink(PostM::ShowBaseLocation().$AssetAndSubAssetURLSuffix."/smart"."/".$request->zip_file->getClientOriginalName());


  }

  public static function StoreHelperDestroy($dir) {
    if (is_dir($dir)) {
      $objects = scandir($dir);
      foreach ($objects as $object) {
        if ($object != "." && $object != "..") {
          if (is_dir($dir."/".$object))
          PostM::StoreHelperDestroy($dir."/".$object);
          else
          unlink($dir."/".$object);
        }
      }
      rmdir($dir);
    }
  }
  public static function Store($SubAssetURL,$EPgCont) {
    // $result = array();
    // $shallowList = scandir($SubAssetURL);
    if (!empty($EPgCont)) {


      // dd($SubAssetURL);
      PostM::StoreHelperDestroy($SubAssetURL."/smart");
      // mkdir($SubAssetURL.array_keys($EPgCont)[0]);

      $EPgCont2['smart'] = $EPgCont;
      // mkdir($SubAssetURL."smart");
      PostM::StoreHelperStore($SubAssetURL,$EPgCont2);

    }
    // return $EPgCont;
  }
  public static function StoreHelperStore($SubAssetURL,$EPgCont) {
    // dd($SubAssetURL.array_keys($EPgCont)[0]);
    // dd(array_keys($EPgCont)[0]);
    // dd($EPgCont);
    foreach($EPgCont as $key => $value) {
      $VPgContItemLoc = $SubAssetURL ."/". $key;
      if (!is_string($value)){
        // mkdir($SubAssetURL.array_keys($EPgCont)[0]);
        mkdir($VPgContItemLoc);

        PostM::StoreHelperStore($VPgContItemLoc, $value);
      } else {
        $content = $value;


        file_put_contents($VPgContItemLoc,$value);


      }
    }

  }



}
