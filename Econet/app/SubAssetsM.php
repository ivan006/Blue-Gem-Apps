<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubAssetsM;
use App\AssetsM;

class SubAssetsM extends Model
{

  public static function allURLs() {
    if (!empty(func_get_args()[0])) {

      $AssetURLSuffix = AssetsM::AssetURLSuffix(func_get_args()[0]);
      $SubAssetURLSuffix = SubAssetsM::SubAssetURLSuffix(func_get_args()[0]);
      $allURLs['sub_assets_read'] =   route('SubAssets.show',$AssetURLSuffix."/".$SubAssetURLSuffix);
      $allURLs['sub_assets_edit'] = route('SubAssets.edit',$AssetURLSuffix."/".$SubAssetURLSuffix);
      // $allURLs['sub_assets_update'] = route('SubAssets.update',$AssetURLSuffix."/".$SubAssetURLSuffix);
      $allURLs['sub_assets_destroy'] = route('SubAssets.destroy',$AssetURLSuffix."/".$SubAssetURLSuffix);
      $allURLs['sub_assets_create'] = route('SubAssets.create');
      // $allURLs['sub_assets_index'] = route('SubAssets.index',$AssetURLSuffix."/".$SubAssetURLSuffix);


      // $allURLs['assets_read'] =   route('Assets.show',AssetsM::AssetURLSuffix(func_get_args()[0]));
      // $allURLs['assets_edit'] = route('Assets.edit',AssetsM::AssetURLSuffix(func_get_args()[0]));
      // $allURLs['assets_update'] = route('Assets.update',AssetsM::AssetURLSuffix(func_get_args()[0]));
      // $allURLs['assets_destroy'] = route('Assets.destroy',AssetsM::AssetURLSuffix(func_get_args()[0]));

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
  // public static function AssetURLs() {
  //   $AssetURLs['assets_read'] = "";
  //   $AssetURLs['assets_create'] = "add";
  //   $AssetURLs['sub_assets_read_suffix'] = "SubAssets";
  //
  //   return $AssetURLs;
  // }
  public static function SubAssetURLSuffix(){

    // $root= AssetsM::siteURL();
    $arguments = func_get_args()[0];
    array_shift($arguments);
    $VPgLoc = '';

    foreach ($arguments as $key => $value) {
      $VPgLoc .= "".$value."/";
    }

    return $VPgLoc;

  }




  public static function SubAssetURL() {
    // dd(func_get_args()[0]);

    return AssetsM::siteURL().AssetsM::AssetURLSuffix(func_get_args()[0])."/".SubAssetsM::SubAssetURLSuffix(func_get_args()[0]);

  }

  public static function SubAssetDeepRead() {
    return  SubAssetsM::deepRead(SubAssetsM::SubAssetURL(func_get_args()[0]));
  }
  public static function deepRead($AssetURL) {
    $result = array();
    $shallowList = scandir($AssetURL);
    foreach ($shallowList as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $VPgContItemLoc = $AssetURL . DIRECTORY_SEPARATOR . $value;
        if (is_dir($VPgContItemLoc)){
          $result[$value] = SubAssetsM::deepRead($VPgContItemLoc);
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


    $AssetURLSuffix = AssetsM::AssetURLSuffix(func_get_args()[0]);
    $AssetURL = AssetsM::AssetURL($AssetURLSuffix);
    $staticdir = AssetsM::AssetURL($AssetURLSuffix);
    // dd($staticdir);
    $result[$AssetURLSuffix] = SubAssetsM::deepList($AssetURL,$staticdir,$AssetURLSuffix);
    // dd($result);

    // $arguments = $request->route()->parameters();
    // // dd($arguments);
    // $AssetURLSuffix = $arguments['a'];
    // $AssetURL = AssetsM::AssetURL($AssetURLSuffix);
    // // dd($AssetURL);
    // $VPgsLocs = SubAssetsM::deepList($AssetURL,$AssetURL,$AssetURLSuffix);
    // // dd($VPgsLocs);

    return $result;
  }

  public static function deepList($AssetURL,$staticdir,$AssetURLSuffix) {
    $result = array();
    // dd ($AssetURL);
    $dataNameList = scandir($AssetURL);

    $url = str_replace($staticdir, "", $AssetURL);
    $result["url"] = route("SubAssets.show")."/".$AssetURLSuffix.$url;
    foreach ($dataNameList as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $dataLocation = $AssetURL . "/" . $value;
        if (is_dir($dataLocation) and basename($dataLocation) !== "smart"){
          $subDataNameList = scandir($dataLocation);
          $blackList = array(".","..","smart","rich.txt");
          $whiteList = array_diff_key($subDataNameList,$blackList);
          if (!empty($whiteList)) {
            $result[$value] = SubAssetsM::deepList($dataLocation,$staticdir,$AssetURLSuffix);
            // $url = str_replace($staticdir."/", "", $dataLocation);
            // $result[$value]["url"] = route("SubAssets.show")."/".$AssetURLSuffix."/".$url;
          } else {
            $url = str_replace($staticdir, "", $dataLocation);
            $result[$value] = route("SubAssets.show")."/".$AssetURLSuffix.$url;
          }
        }
      }
    }
    return $result;
  }


  public static function EPgCont($AssetURL,$EPgCont) {
    // $result = array();
    // $shallowList = scandir($AssetURL);
    foreach($EPgCont as $key => $value) {
      $VPgContItemLoc = $AssetURL . DIRECTORY_SEPARATOR . $key;
      if (!is_string($value)){
        // mkdir($VPgContItemLoc);

        SubAssetsM::EPgCont($VPgContItemLoc, $value);
      } else {
        $content = $value;

        $InflictedFile = fopen($VPgContItemLoc,"w");
        fwrite($InflictedFile,$content);
        fclose($InflictedFile);
      }
    }
    // return $EPgCont;
  }






}
