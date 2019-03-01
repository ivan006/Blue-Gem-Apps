<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blogM extends Model
{
  public static function ViewPagePath($a,$b){
    $s = "/";
    if (isset($b)) {
      $ViewPagePath = $s.$a.$s.$b;
      return $ViewPagePath;
    } elseif (isset($a)) {
      $ViewPagePath = $s.$a;
      return  $ViewPagePath;
    } else {
      $ViewPagePath = null;
      return  $ViewPagePath;
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

  public static function ViewPageList($dir) {
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
            $result[$value] = self::ViewPageList($sub_dir);
            $url = str_replace("../public/images/", "", $sub_dir);
            $result[$value]["url"] = url('/')."/blog/".$url;
          } else {
            $url = str_replace("../public/images/", "", $sub_dir);
            $result[$value] = url('/')."/blog/".$url;
          }
        }
      }
    }
    return $result;
  }
  public static function SavePageContent($dir) {

  }
  public static function ViewPagesDir($dir) {

  }





}
