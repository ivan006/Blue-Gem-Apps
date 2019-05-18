<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\postsM;
use App\groupsM;

class groupsM extends Model
{




  public static function groupsList() {
    $groupURL = groupsM::siteURL();
    $staticdir  = groupsM::siteURL();
    $result = array();
    $dataNameList = scandir($groupURL);
    foreach ($dataNameList as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $dataLocation = $groupURL . "/" . $value;
        if (is_dir($dataLocation) and basename($dataLocation) !== "smart"){
          $subDataNameList = scandir($dataLocation);
          $blackList = array(".","..","smart","rich.txt");
          $whiteList = array_diff_key($subDataNameList,$blackList);
          if (!empty($whiteList)) {
            // $result[$value] = postsM::deepList($dataLocation,$staticdir);
            $url = str_replace($staticdir."/", "", $dataLocation);
            $result[$value]["url"] = url('/')."/".postsM::groupURLs()['posts_read_suffix']."/".$url;
          } else {
            $url = str_replace($staticdir."/", "", $dataLocation);
            $result[$value] = url('/')."/".postsM::groupURLs()['posts_read_suffix']."/".$url;
          }
        }
      }
    }

    return $result;
  }





  public static function VPgContForGroup($a,$b) {
    $result = array();
    $VPgContItem = scandir($siteURL);
    foreach ($VPgContItem as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $VPgContItemLoc = $siteURL . DIRECTORY_SEPARATOR . $value;

          $result[$value] = file_get_contents($VPgContItemLoc);

      }
    }
    return  $result;
  }



  public static function groupURL() {
    return groupsM::siteURL()."/hey";
  }
  public static function siteURL() {
    return "../public/images";
  }






}
