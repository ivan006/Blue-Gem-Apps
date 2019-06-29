<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\AssetsM;
use App\SubassetsM;
use App\MetadataM;





class NetworkM extends Model
{



  public static function ShowAssets() {
    $SubassetURL = AssetsM::ShowBaseLocation();
    $staticdir  = AssetsM::ShowBaseLocation();
    $result = array();
    $dataNameList = scandir($SubassetURL);
    foreach ($dataNameList as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $dataLocation = $SubassetURL . "/" . $value;
        if (is_dir($dataLocation) and basename($dataLocation) !== "smart"){
          $subDataNameList = scandir($dataLocation);
          $blackList = array(".","..","smart","rich.txt");
          $whiteList = array_diff_key($subDataNameList,$blackList);
          if (!empty($whiteList)) {
            // $result[$value] = AssetsM::ShowIndirectSubassetsHelper($dataLocation,$staticdir);
            $url = str_replace($staticdir."/", "", $dataLocation);
            $result[$value]["url"] = route('Assets.show', $url);
          } else {
            $url = str_replace($staticdir."/", "", $dataLocation);
            $result[$value] = route('Assets.show', $url);
          }
        }
      }
    }

    return $result;
  }
  // public static function VPgContForAsset($a,$b) {
  //   $result = array();
  //   $VPgContItem = scandir($siteURL);
  //   foreach ($VPgContItem as $key => $value) {
  //     if (!in_array($value,array(".","..")))  {
  //       $VPgContItemLoc = $siteURL . DIRECTORY_SEPARATOR . $value;
  //
  //       $result[$value] = file_get_contents($VPgContItemLoc);
  //
  //     }
  //   }
  //   return  $result;
  // }
  public static function ShowLocation() {
    // dd(func_get_args()[0]);
    return AssetsM::ShowBaseLocation().func_get_args()[0];
  }
  // public static function ShowLocation($value) {
  //   return AssetsM::ShowBaseLocation()."/".$value;
  // }

  // public static function AssetURLs() {
  //   $SubassetURLs['assets_read'] = "";
  //   $SubassetURLs['assets_create'] = "add";
  //   $SubassetURLs['sub_assets_read_suffix'] = "SubAssets";
  //
  //   return $SubassetURLs;
  // }


  // public static function ShowID(){
  //
  //   // $VPgLoc = '';
  //   // foreach (func_get_args()[0] as $key => $value) {
  //   //   $VPgLoc .= "".$value."/";
  //   // }
  //
  //   return func_get_args()[0][0];
  // }

  public static function Store($request) {
    mkdir(self::BaseLocation()."/".$request->get('name'));
  }





}
