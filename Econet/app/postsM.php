<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\postsM;
use App\groupsM;
use App\toolsM;

class postsM extends Model
{


  public static function postURLSuffix($a,$b){
    $s = "/";
    $root= groupsM::siteURL();
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




  public static function postURL($a,$b) {
    return groupsM::siteURL().postsM::postURLSuffix($a,$b);
  }

  public static function postDeepList($a,$b) {
    return  postsM::deepList(postsM::postURL($a,$b));
  }
  public static function deepList($groupURL) {
    $result = array();
    $shallowList = scandir($groupURL);
    foreach ($shallowList as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $VPgContItemLoc = $groupURL . DIRECTORY_SEPARATOR . $value;
        if (is_dir($VPgContItemLoc)){
          $result[$value] = postsM::deepList($VPgContItemLoc);
        } else {
          $result[$value] = file_get_contents($VPgContItemLoc);
        }
      }
    }
    return  $result;
  }

  public static function postsDeepRead($a,$b) {
    $groupURL = postsM::postURL($a,$b);
    $staticdir = postsM::postURL($a,$b);
    $result = postsM::deepRead($groupURL,$staticdir);
    return $result;
  }

  public static function deepRead($groupURL,$staticdir) {
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
            $result[$value] = postsM::deepRead($dataLocation,$staticdir);
            $url = str_replace($staticdir."/", "", $dataLocation);
            $result[$value]["url"] = url('/')."/blog/".$url;
          } else {
            $url = str_replace($staticdir."/", "", $dataLocation);
            $result[$value] = url('/')."/blog/".$url;
          }
        }
      }
    }

    return $result;
  }


  public static function EPgCont($groupURL,$EPgCont) {
    // $result = array();
    // $shallowList = scandir($groupURL);
    foreach($EPgCont as $key => $value) {
      $VPgContItemLoc = $groupURL . DIRECTORY_SEPARATOR . $key;
      if (!is_string($value)){
        // mkdir($VPgContItemLoc);

        postsM::EPgCont($VPgContItemLoc, $value);
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
