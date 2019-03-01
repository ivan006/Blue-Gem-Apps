<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blogM extends Model
{
  public static function ViewPageModes($a,$b){
    $s = "/";
    $prefix = "blog";
    $suffix = "Edit";
    if (isset($b)) {
      $dir = $prefix.$s.$a.$s.$b;
      $dir2 = $prefix.$suffix.$s.$a.$s.$b;
      return  array("dir" =>$dir, "dir2" => $dir2);
    } elseif (isset($a)) {
      $dir = $prefix.$s.$a;
      $dir2 = $prefix.$suffix.$s.$a;
      return  array("dir" =>$dir, "dir2" => $dir2);
    } else {
      $dir = $prefix;
      $dir2 = $prefix.$suffix;
      return  array("dir" =>$dir, "dir2" => $dir2);
    }
  }

  public static function ViewPageContentDir($a,$b){
    $s = "/";
    $root= '../public/images';
    if (isset($b)) {
      $dir = $root.$s.$a.$s.$b;
      if (is_dir($dir)) {
        return $dir;
      } else {
        return $root;
      }
    } elseif (isset($a)) {
      $dir = $root.$s.$a;
      if (is_dir($dir)) {
        return $dir;
      } else {
        return $root;
      }
    } else {
      $dir = $root;
      if (is_dir($dir)) {
        return $dir;
      } else {
        return $root;
      }
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
            $result[$value]["url"] = "http://b-blog.test/blog/".$url;
          } else {
            $url = str_replace("../public/images/", "", $sub_dir);
            $result[$value] = "http://b-blog.test/blog/".$url;
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
