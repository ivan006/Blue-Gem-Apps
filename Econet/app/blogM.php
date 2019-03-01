<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blogM extends Model
{
  public static function ViewPageLocation($dir,$a,$b){
    $s = "/";
    $root= $dir;
    if (isset($b)) {
      $ViewPageLocation = $s.$a.$s.$b;
      if (is_dir($root.$ViewPageLocation)) {
        return $ViewPageLocation;
      } else {
        return null;
      }
    } elseif (isset($a)) {
      $ViewPageLocation = $s.$a;
      if (is_dir($root.$ViewPageLocation)) {
        return $ViewPageLocation;
      } else {
        return null;
      }
    } else {
      return  null;
    }
  }





  public static function ViewPageContent($dir) {
    $result = array();
    $cdir = scandir($dir);
    foreach ($cdir as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $sub_dir = $dir . DIRECTORY_SEPARATOR . $value;
        if (is_dir($sub_dir)){
          $result[$value] = self::ViewPageContent($sub_dir);
        } else {
          $result[$value] = file_get_contents($sub_dir);
        }
      }
    }
    return  $result;
  }

  public static function ViewPagesLocations($dir,$staticdir) {
    $result = array();
    $cdir = scandir($dir);
    foreach ($cdir as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $sub_dir = $dir . DIRECTORY_SEPARATOR . $value;
        if (is_dir($sub_dir) and basename($sub_dir) !== "smart"){
          $sub_sub_dirs = scandir($sub_dir);
          $a1 = array(".","..","smart","rich.txt");
          $dif = array_diff_key($sub_sub_dirs,$a1);
          if (!empty($dif)) {
            $result[$value] = self::ViewPagesLocations($sub_dir,$staticdir);
            $url = str_replace($staticdir."/", "", $sub_dir);
            $result[$value]["url"] = url('/')."/blog/".$url;
          } else {
            $url = str_replace($staticdir."/", "", $sub_dir);
            $result[$value] = url('/')."/blog/".$url;
          }
        }
      }
    }
    return $result;
  }
  public static function SavePageContent($dir) {

  }
  public static function ViewPagesLocationBase() {
    return "../public/images";
  }





}
