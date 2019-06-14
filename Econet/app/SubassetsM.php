<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\AssetsM;
use App\SubassetsM;
use App\MetadataM;
use App\URLsM;




class SubassetsM extends Model
{

  public static function upload($arguments, $request) {



    $AssetURLSuffix = URLsM::AssetURLSuffix($arguments);
    $SubAssetURLSuffix = URLsM::SubAssetURLSuffix($arguments);
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

  public static function SubAssetDeepRead() {
    return  SubassetsM::deepRead(URLsM::SubAssetURL(func_get_args()[0]));
  }
  public static function deepRead($AssetURL) {
    $result = array();
    $shallowList = scandir($AssetURL);
    foreach ($shallowList as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $VPgContItemLoc = $AssetURL . DIRECTORY_SEPARATOR . $value;
        if (is_dir($VPgContItemLoc)){
          $result[$value] = SubassetsM::deepRead($VPgContItemLoc);
        } else {
          $result[$value] = file_get_contents($VPgContItemLoc);
        }
      }
    }
    return  $result;
  }
  public static function SubAssetsDeepList() {
    // $arguments = func_get_args()[0];
    // array_shift($arguments);


    $AssetURLSuffix = URLsM::AssetURLSuffix(func_get_args()[0]);
    $AssetURL = URLsM::AssetURL($AssetURLSuffix);
    $staticdir = URLsM::AssetURL($AssetURLSuffix);
    // dd($staticdir);
    $result[$AssetURLSuffix] = SubassetsM::deepList($AssetURL,$staticdir,$AssetURLSuffix);
    // dd($result);

    // $arguments = $request->route()->parameters();
    // // dd($arguments);
    // $AssetURLSuffix = $arguments['a'];
    // $AssetURL = URLsM::AssetURL($AssetURLSuffix);
    // // dd($AssetURL);
    // $VPgsLocs = SubassetsM::deepList($AssetURL,$AssetURL,$AssetURLSuffix);
    // // dd($VPgsLocs);

    return $result;
  }
  public static function deepList($AssetURL,$staticdir,$AssetURLSuffix) {
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
            $result[$value] = SubassetsM::deepList($dataLocation,$staticdir,$AssetURLSuffix);
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
  public static function rrmdir($dir) {
    if (is_dir($dir)) {
      $objects = scandir($dir);
      foreach ($objects as $object) {
        if ($object != "." && $object != "..") {
          if (is_dir($dir."/".$object))
          SubassetsM::rrmdir($dir."/".$object);
          else
          unlink($dir."/".$object);
        }
      }
      rmdir($dir);
    }
  }
  public static function StoreSubAsset($SubAssetURL,$EPgCont) {
    // $result = array();
    // $shallowList = scandir($SubAssetURL);
    if (!empty($EPgCont)) {


      // dd($SubAssetURL);
      SubassetsM::rrmdir($SubAssetURL."/smart");
      // mkdir($SubAssetURL.array_keys($EPgCont)[0]);

      $EPgCont2['smart'] = $EPgCont;
      // mkdir($SubAssetURL."smart");
      SubassetsM::EPgCont($SubAssetURL,$EPgCont2);

    }
    // return $EPgCont;
  }
  public static function EPgCont($SubAssetURL,$EPgCont) {
    // dd($SubAssetURL.array_keys($EPgCont)[0]);
    // dd(array_keys($EPgCont)[0]);
    // dd($EPgCont);
    foreach($EPgCont as $key => $value) {
      $VPgContItemLoc = $SubAssetURL ."/". $key;
      if (!is_string($value)){
        // mkdir($SubAssetURL.array_keys($EPgCont)[0]);
        mkdir($VPgContItemLoc);

        SubassetsM::EPgCont($VPgContItemLoc, $value);
      } else {
        $content = $value;


        file_put_contents($VPgContItemLoc,$value);


      }
    }

  }



}
