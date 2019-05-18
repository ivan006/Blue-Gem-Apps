<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\postsM;
use App\groupsM;

class postsM extends Model
{

  public static function allTools($a,$b) {
    $all_tools['posts_read'] = postsM::groupTools()['posts_read_suffix'].postsM::postURLSuffix($a,$b);
    $all_tools['posts_update'] = postsM::groupTools()['posts_read_suffix']."Edit".postsM::postURLSuffix($a,$b);
    $all_tools['groups_read'] = postsM::groupTools()['groups_read'];
    $all_tools['groups_create'] = postsM::groupTools()['groups_create'];
    $all_tools['posts_read_suffix'] = postsM::groupTools()['posts_read_suffix'];


    return $all_tools;
  }
  public static function groupTools() {
    $group_tools['groups_read'] = "groups";
    $group_tools['groups_create'] = "add";
    $group_tools['posts_read_suffix'] = "posts";

    return $group_tools;
  }
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

  public static function postDeepRead($a,$b) {
    return  postsM::deepRead(postsM::postURL($a,$b));
  }
  public static function deepRead($groupURL) {
    $result = array();
    $shallowList = scandir($groupURL);
    foreach ($shallowList as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $VPgContItemLoc = $groupURL . DIRECTORY_SEPARATOR . $value;
        if (is_dir($VPgContItemLoc)){
          $result[$value] = postsM::deepRead($VPgContItemLoc);
        } else {
          $result[$value] = file_get_contents($VPgContItemLoc);
        }
      }
    }
    return  $result;
  }

  public static function postsDeepList($a,$b) {
    $groupURL = postsM::postURL($a,$b);
    $staticdir = postsM::postURL($a,$b);
    $result = postsM::deepList($groupURL,$staticdir);
    return $result;
  }

  public static function deepList($groupURL,$staticdir) {
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
            $result[$value] = postsM::deepList($dataLocation,$staticdir);
            $url = str_replace($staticdir."/", "", $dataLocation);
            $result[$value]["url"] = url('/')."/".postsM::groupTools()['posts_read_suffix']."/".$url;
          } else {
            $url = str_replace($staticdir."/", "", $dataLocation);
            $result[$value] = url('/')."/".postsM::groupTools()['posts_read_suffix']."/".$url;
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
