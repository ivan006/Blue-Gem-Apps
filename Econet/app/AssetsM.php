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
    array_shift($arguments);
    $VPgLoc = '';


    foreach ($arguments as $key => $value) {
      $VPgLoc .= "/".$value;
    }


    return $VPgLoc;

  }
  public static function ShowBaseLocation() {
    return "../storage/app/";
  }
  public static function ShowLocation() {

    // dd(func_get_args()[0]);
    // echo AssetsM::ShowBaseLocation().NetworkM::ShowID(func_get_args()[0])."/".AssetsM::ShowID(func_get_args()[0]);

    $arguments = func_get_args()[0];
    array_shift($arguments);
    // var_dump($arguments);
    if (!empty($arguments)) {

      return  AssetsM::ShowBaseLocation().NetworkM::ShowID(func_get_args()[0]).AssetsM::ShowID(func_get_args()[0]);
    } else {
      return  AssetsM::ShowBaseLocation().NetworkM::ShowID(func_get_args()[0]);

    }

  }
  public static function ShowActions() {

    if (!empty(func_get_args()[0])) {

      $AssetURLSuffix = NetworkM::ShowID(func_get_args()[0]);
      $SubAssetURLSuffix = AssetsM::ShowID(func_get_args()[0]);
      $allURLs['sub_assets_read'] =   route('Assets.show',$AssetURLSuffix.$SubAssetURLSuffix);
      $allURLs['sub_assets_edit'] = route('Assets.edit',$AssetURLSuffix.$SubAssetURLSuffix);

      // $allURLs['sub_assets_update'] = route('Assets.update',$AssetURLSuffix.$SubAssetURLSuffix);
      $allURLs['sub_assets_destroy'] = route('Assets.destroy',$AssetURLSuffix.$SubAssetURLSuffix);
      $allURLs['sub_assets_store'] = route('Assets.store',$AssetURLSuffix.$SubAssetURLSuffix);
      $allURLs['sub_assets_create'] = route('Assets.create');
      // $allURLs['sub_assets_index'] = route('Assets.index',$AssetURLSuffix.$SubAssetURLSuffix);


      // $allURLs['assets_read'] =   route('Assets.show',NetworkM::ShowID(func_get_args()[0]));
      // $allURLs['assets_edit'] = route('Assets.edit',NetworkM::ShowID(func_get_args()[0]));
      // $allURLs['assets_update'] = route('Assets.update',NetworkM::ShowID(func_get_args()[0]));
      // $allURLs['assets_destroy'] = route('Assets.destroy',NetworkM::ShowID(func_get_args()[0]));

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

  public static function ShowIndirectDataHelper($AssetURL) {
    $result = array();
    $shallowList = scandir($AssetURL);
    foreach ($shallowList as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $VPgContItemLoc = $AssetURL . DIRECTORY_SEPARATOR . $value;
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


    $AssetURLSuffix = NetworkM::ShowID(func_get_args()[0]);
    $AssetURL = NetworkM::ShowLocation($AssetURLSuffix);
    $staticdir = NetworkM::ShowLocation($AssetURLSuffix);
    // dd($staticdir);
    $result[$AssetURLSuffix] = AssetsM::ShowIndirectSubassetsHelper($AssetURL,$staticdir,$AssetURLSuffix);
    // dd($result);

    // $arguments = $request->route()->parameters();
    // // dd($arguments);
    // $AssetURLSuffix = $arguments['a'];
    // $AssetURL = NetworkM::ShowLocation($AssetURLSuffix);
    // // dd($AssetURL);
    // $VPgsLocs = AssetsM::ShowIndirectSubassetsHelper($AssetURL,$AssetURL,$AssetURLSuffix);
    // // dd($VPgsLocs);

    return $result;
  }
  public static function ShowIndirectSubassetsHelper($AssetURL,$staticdir,$AssetURLSuffix) {
    $result = array();
    // dd ($AssetURL);
    $dataNameList = scandir($AssetURL);

    $url = str_replace($staticdir, "", $AssetURL);
    $result["url"] = route("Assets.show")."/".$AssetURLSuffix.$url;
    foreach ($dataNameList as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $dataLocation = $AssetURL . "/" . $value;
        if (is_dir($dataLocation) and basename($dataLocation) !== "smart"){
          $subDataNameList = scandir($dataLocation);
          $blackList = array(".","..","smart","rich.txt");
          $whiteList = array_diff_key($subDataNameList,$blackList);
          if (!empty($whiteList)) {
            $result[$value] = AssetsM::ShowIndirectSubassetsHelper($dataLocation,$staticdir,$AssetURLSuffix);
            // $url = str_replace($staticdir."/", "", $dataLocation);
            // $result[$value]["url"] = route("Assets.show")."/".$AssetURLSuffix."/".$url;
          } else {
            $url = str_replace($staticdir, "", $dataLocation);
            $result[$value] = route("Assets.show")."/".$AssetURLSuffix.$url;
          }
        }
      }
    }
    return $result;
  }


  public static function upload($arguments, $request) {



    $AssetURLSuffix = NetworkM::ShowID($arguments);
    $SubAssetURLSuffix = AssetsM::ShowID($arguments);
    $AssetAndSubAssetURLSuffix = $AssetURLSuffix.$SubAssetURLSuffix;


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
