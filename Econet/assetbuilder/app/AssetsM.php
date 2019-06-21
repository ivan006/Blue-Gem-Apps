<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\NetworkM;
use App\AssetsM;
use App\MetadataM;





class AssetsM extends Model
{
  public static function ShowID(){

    // $root= AssetsM::ShowBaseLocation();
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
    return "../assetbuilder/storage/app/";
  }
  public static function ShowBaseID() {
      $arguments = func_get_args()[0][0];

    return $arguments;
  }
  public static function ShowBaseIDPlusBaseLocation() {
    return AssetsM::ShowBaseLocation().AssetsM::ShowBaseID(func_get_args()[0]);
  }
  public static function ShowLocation() {

    // dd(func_get_args()[0]);
    // echo AssetsM::ShowBaseLocation().AssetsM::ShowID(func_get_args()[0]);

    $arguments = func_get_args()[0];
    // array_shift($arguments);
    // var_dump($arguments);
    if (!empty($arguments)) {

      return  AssetsM::ShowBaseLocation().AssetsM::ShowID(func_get_args()[0]);
    } else {
      // return  AssetsM::ShowBaseLocation().NetworkM::ShowID(func_get_args()[0]);
      return "now what";
    }

  }
  public static function ShowActions() {

    if (!empty(func_get_args()[0])) {


      $SubAssetURLSuffix = AssetsM::ShowID(func_get_args()[0]);
      $allURLs['sub_assets_read'] =   route('Assets.show',$SubAssetURLSuffix);
      $allURLs['sub_assets_edit'] = route('Assets.edit',$SubAssetURLSuffix);

      // $allURLs['sub_assets_update'] = route('Assets.update',$SubassetURLSuffix.$SubAssetURLSuffix);
      $allURLs['sub_assets_destroy'] = route('Assets.destroy',$SubAssetURLSuffix);
      $allURLs['sub_assets_store'] = route('Assets.store',$SubAssetURLSuffix);
      $allURLs['sub_assets_create'] = route('Assets.create');
      // $allURLs['sub_assets_index'] = route('Assets.index',$SubassetURLSuffix.$SubAssetURLSuffix);



      $allURLs['assets_create'] = route('Assets.create');
      $allURLs['assets_index'] = route('Assets.index');
    } else {
      $allURLs['sub_assets_read'] =   " ";
      $allURLs['sub_assets_edit'] = " ";

      $allURLs['sub_assets_destroy'] =  " ";
      $allURLs['sub_assets_create'] =  " ";


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
          $result[$value] = AssetsM::ShowIndirectDataHelper($VPgContItemLoc);
        } else {
          $result[$value] = file_get_contents($VPgContItemLoc);
        }
      }
    }
    return  $result;
  }
  public static function ShowIndirectData() {
    return  AssetsM::ShowIndirectDataHelper(AssetsM::ShowLocation(func_get_args()[0]));
  }
  public static function ShowIndirectSubassets() {
    // $arguments = func_get_args()[0];
    // array_shift($arguments);
    // dd(func_get_args()[0]);

    $SubassetURLSuffix = AssetsM::ShowID(func_get_args()[0]);
    $SubassetURL = NetworkM::ShowLocation($SubassetURLSuffix);
    $staticdir = NetworkM::ShowLocation($SubassetURLSuffix);
    // dd($staticdir);
    $result[$SubassetURLSuffix] = AssetsM::ShowIndirectSubassetsHelper($SubassetURL,$staticdir,$SubassetURLSuffix);
    // dd($result);

    // $arguments = $request->route()->parameters();
    // // dd($arguments);
    // $SubassetURLSuffix = $arguments['a'];
    // $SubassetURL = NetworkM::ShowLocation($SubassetURLSuffix);
    // // dd($SubassetURL);
    // $VPgsLocs = AssetsM::ShowIndirectSubassetsHelper($SubassetURL,$SubassetURL,$SubassetURLSuffix);
    // // dd($VPgsLocs);

    return $result;
  }
  public static function ShowIndirectSubassetsHelper($SubassetURL,$staticdir,$SubassetURLSuffix) {
    $result = array();
    // dd ($SubassetURL);
    $dataNameList = scandir($SubassetURL);

    $url = str_replace($staticdir, "", $SubassetURL);
    $result["url"] = route("Assets.show")."/".$SubassetURLSuffix.$url;
    foreach ($dataNameList as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $dataLocation = $SubassetURL . "/" . $value;
        if (is_dir($dataLocation) and basename($dataLocation) !== "smart"){
          $subDataNameList = scandir($dataLocation);
          $blackList = array(".","..","smart","rich.txt");
          $whiteList = array_diff_key($subDataNameList,$blackList);
          if (!empty($whiteList)) {
            $result[$value] = AssetsM::ShowIndirectSubassetsHelper($dataLocation,$staticdir,$SubassetURLSuffix);
            // $url = str_replace($staticdir."/", "", $dataLocation);
            // $result[$value]["url"] = route("Assets.show")."/".$SubassetURLSuffix."/".$url;
          } else {
            $url = str_replace($staticdir, "", $dataLocation);
            $result[$value] = route("Assets.show")."/".$SubassetURLSuffix.$url;
          }
        }
      }
    }
    return $result;
  }


  public static function upload($arguments, $request) {



    $SubAssetURLSuffix = AssetsM::ShowID($arguments);
    $AssetAndSubAssetURLSuffix = $SubAssetURLSuffix;


    $request->zip_file->storeAs($AssetAndSubAssetURLSuffix, $request->zip_file->getClientOriginalName());

    // $path = "Econet/storage/app/".$AssetAndSubAssetURLSuffix."/".$request->zip_file->getClientOriginalName();
    // $path = "../storage/app/".$AssetAndSubAssetURLSuffix."/".$request->zip_file->getClientOriginalName();
    $path = "../storage/app/".$AssetAndSubAssetURLSuffix."/".$request->zip_file->getClientOriginalName();
    // dd($path);
    // $Path = public_path($AssetAndSubAssetURLSuffix);


    $zipper = new \Chumper\Zipper\Zipper;
    $zipper->make($path)->extractTo("../storage/app/".$AssetAndSubAssetURLSuffix."/");
    $zipper->close();
    unlink("../storage/app/".$AssetAndSubAssetURLSuffix."/".$request->zip_file->getClientOriginalName());


  }
  public static function StoreHelperDestroy($dir) {
    if (is_dir($dir)) {
      $objects = scandir($dir);
      foreach ($objects as $object) {
        if ($object != "." && $object != "..") {
          if (is_dir($dir."/".$object))
          AssetsM::StoreHelperDestroy($dir."/".$object);
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
      AssetsM::StoreHelperDestroy($SubAssetURL."/smart");
      // mkdir($SubAssetURL.array_keys($EPgCont)[0]);

      $EPgCont2['smart'] = $EPgCont;
      // mkdir($SubAssetURL."smart");
      AssetsM::StoreHelperStore($SubAssetURL,$EPgCont2);

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

        AssetsM::StoreHelperStore($VPgContItemLoc, $value);
      } else {
        $content = $value;


        file_put_contents($VPgContItemLoc,$value);


      }
    }

  }



}
