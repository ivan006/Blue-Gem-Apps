<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\WebDocM;
use App\SubWebDocM;
use App\SmartDataItemM;
use App\SmartDataArrayM;





class NetworkM extends Model
{


  public static function ShowBaseLocation() {
    // return "storage/app/public/";
    return base_path()."/storage/app/public/";
  }
  public static function ShowWebDoc() {
    $ShowBaseLocation = NetworkM::ShowBaseLocation();
    $staticdir  = NetworkM::ShowBaseLocation();
    $result = array();
    $dataNameList = scandir($ShowBaseLocation);
    foreach ($dataNameList as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $dataLocation = $ShowBaseLocation . "/" . $value;
        if (is_dir($dataLocation) and basename($dataLocation) !== SmartDataArrayM::ShowBaseLocation()){
          $subDataNameList = scandir($dataLocation);
          $blackList = array(".","..",SmartDataArrayM::ShowBaseLocation(),"rich.txt");
          $whiteList = array_diff_key($subDataNameList,$blackList);
          if (!empty($whiteList)) {
            // $result[$value] = WebDocM::ShowSubWebDocHelper($dataLocation,$staticdir);
            $url = str_replace($staticdir."/", "", $dataLocation);
            $result[$value]["url"] = route('WebDoc.show', $url);
          } else {
            $url = str_replace($staticdir."/", "", $dataLocation);
            $result[$value] = route('WebDoc.show', $url);
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
  //       $DataLocation = $siteURL . DIRECTORY_SEPARATOR . $value;
  //
  //       $result[$value] = file_get_contents($DataLocation);
  //
  //     }
  //   }
  //   return  $result;
  // }
  public static function ShowLocation() {
    // dd(func_get_args()[0]);
    return NetworkM::ShowBaseLocation().func_get_args()[0];
  }
  // public static function ShowLocation($value) {
  //   return NetworkM::ShowBaseLocation()."/".$value;
  // }

  // public static function AssetURLs() {
  //   $ShowBaseLocations['webdoc_read'] = "";
  //   $ShowBaseLocations['webdoc_create'] = "add";
  //   $ShowBaseLocations['sub_webdoc_read_suffix'] = "SubWebDoc";
  //
  //   return $ShowBaseLocations;
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
