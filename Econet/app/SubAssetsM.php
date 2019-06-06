<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubAssetsM;
use App\AssetsM;

class SubAssetsM extends Model
{

  public static function allURLs($a,$b) {
    $allURLs['sub_assets_read'] = SubAssetsM::AssetURLs()['sub_assets_read_suffix'].SubAssetsM::SubAssetURLSuffix($a,$b);
    $allURLs['sub_assets_update'] = SubAssetsM::AssetURLs()['sub_assets_read_suffix']."Edit".SubAssetsM::SubAssetURLSuffix($a,$b);
    $allURLs['assets_read'] = SubAssetsM::AssetURLs()['assets_read'];
    $allURLs['assets_create'] = SubAssetsM::AssetURLs()['assets_create'];
    $allURLs['sub_assets_read_suffix'] = SubAssetsM::AssetURLs()['sub_assets_read_suffix'];


    return $allURLs;
  }
  public static function AssetURLs() {
    $AssetURLs['assets_read'] = "";
    $AssetURLs['assets_create'] = "add";
    $AssetURLs['sub_assets_read_suffix'] = "SubAssets";

    return $AssetURLs;
  }
  public static function SubAssetURLSuffix($a,$b){
    $s = "/";
    $root= AssetsM::siteURL();
    if (isset($b)) {
      $VPgLoc = $s.$a.$s.$b;
      if (is_dir($root.$VPgLoc)) {
        return $VPgLoc;
      } else {
        return null;
      }
    } elseif (isset($a)) {
      $VPgLoc = $s.$a;
      if (is_dir($root.$VPgLoc)) {
        return $VPgLoc;
      } else {
        return null;
      }
    } else {
      return  null;
    }
  }




  public static function SubAssetURL($a,$b) {
    return AssetsM::siteURL().SubAssetsM::SubAssetURLSuffix($a,$b);
  }

  public static function SubAssetDeepRead($a,$b) {
    return  SubAssetsM::deepRead(SubAssetsM::SubAssetURL($a,$b));
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

  public static function SubAssetsDeepList($a,$b) {
    $AssetURL = SubAssetsM::SubAssetURL($a,$b);
    $staticdir = SubAssetsM::SubAssetURL($a,$b);
    $result = SubAssetsM::deepList($AssetURL,$staticdir);
    return $result;
  }

  public static function deepList($AssetURL,$staticdir) {
    $result = array();
    $dataNameList = scandir($AssetURL);
    foreach ($dataNameList as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $dataLocation = $AssetURL . "/" . $value;
        if (is_dir($dataLocation) and basename($dataLocation) !== "smart"){
          $subDataNameList = scandir($dataLocation);
          $blackList = array(".","..","smart","rich.txt");
          $whiteList = array_diff_key($subDataNameList,$blackList);
          if (!empty($whiteList)) {
            $result[$value] = SubAssetsM::deepList($dataLocation,$staticdir);
            $url = str_replace($staticdir."/", "", $dataLocation);
            $result[$value]["url"] = url('/')."/".SubAssetsM::AssetURLs()['sub_assets_read_suffix']."/".$url;
          } else {
            $url = str_replace($staticdir."/", "", $dataLocation);
            $result[$value] = url('/')."/".SubAssetsM::AssetURLs()['sub_assets_read_suffix']."/".$url;
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
