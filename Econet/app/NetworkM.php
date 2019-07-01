<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\PostM;
use App\SubPostM;
use App\SmartDataM;





class NetworkM extends Model
{



  public static function ShowPost() {
    $SubassetURL = PostM::ShowBaseLocation();
    $staticdir  = PostM::ShowBaseLocation();
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
            // $result[$value] = PostM::ShowIndirectSubPostHelper($dataLocation,$staticdir);
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
    return PostM::ShowBaseLocation().func_get_args()[0];
  }
  // public static function ShowLocation($value) {
  //   return PostM::ShowBaseLocation()."/".$value;
  // }

  // public static function AssetURLs() {
  //   $SubassetURLs['post_read'] = "";
  //   $SubassetURLs['post_create'] = "add";
  //   $SubassetURLs['sub_post_read_suffix'] = "SubPost";
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
