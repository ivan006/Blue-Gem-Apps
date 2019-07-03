<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\PostM;
use App\SubPostM;
use App\SmartDataM;





class NetworkM extends Model
{


  public static function ShowBaseLocation() {
    return "storage/app/public/";
  }
  public static function ShowPost() {
    $ShowBaseLocation = NetworkM::ShowBaseLocation();
    $staticdir  = NetworkM::ShowBaseLocation();
    $result = array();
    $dataNameList = scandir($ShowBaseLocation);
    foreach ($dataNameList as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $dataLocation = $ShowBaseLocation . "/" . $value;
        if (is_dir($dataLocation) and basename($dataLocation) !== "smart"){
          $subDataNameList = scandir($dataLocation);
          $blackList = array(".","..","smart","rich.txt");
          $whiteList = array_diff_key($subDataNameList,$blackList);
          if (!empty($whiteList)) {
            // $result[$value] = PostM::ShowSubPostHelper($dataLocation,$staticdir);
            $url = str_replace($staticdir."/", "", $dataLocation);
            $result[$value]["url"] = route('Post.show', $url);
          } else {
            $url = str_replace($staticdir."/", "", $dataLocation);
            $result[$value] = route('Post.show', $url);
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
  //   $ShowBaseLocations['post_read'] = "";
  //   $ShowBaseLocations['post_create'] = "add";
  //   $ShowBaseLocations['sub_post_read_suffix'] = "SubPost";
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
