<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blogM extends Model
{
  public static function VPgLoc($VPgsLocBase,$a,$b){
    $s = "/";
    $root= $VPgsLocBase;
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






  public static function VPgCont($VPgsLocBase) {
    $result = array();
    $VPgContItem = scandir($VPgsLocBase);
    foreach ($VPgContItem as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $VPgContItemLoc = $VPgsLocBase . DIRECTORY_SEPARATOR . $value;
        if (is_dir($VPgContItemLoc)){
          $result[$value] = self::VPgCont($VPgContItemLoc);
        } else {
          $result[$value] = file_get_contents($VPgContItemLoc);
        }
      }
    }
    return  $result;
  }

  public static function VPgsLocs($VPgsLocBase,$staticdir) {
    $result = array();
    $VPgContItem = scandir($VPgsLocBase);
    foreach ($VPgContItem as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $VPgContItemLoc = $VPgsLocBase . DIRECTORY_SEPARATOR . $value;
        if (is_dir($VPgContItemLoc) and basename($VPgContItemLoc) !== "smart"){
          $VPgContItemSubLoc = scandir($VPgContItemLoc);
          $a1 = array(".","..","smart","rich.txt");
          $dif = array_diff_key($VPgContItemSubLoc,$a1);
          if (!empty($dif)) {
            $result[$value] = self::VPgsLocs($VPgContItemLoc,$staticdir);
            $url = str_replace($staticdir."/", "", $VPgContItemLoc);
            $result[$value]["url"] = url('/')."/blog/".$url;
          } else {
            $url = str_replace($staticdir."/", "", $VPgContItemLoc);
            $result[$value] = url('/')."/blog/".$url;
          }
        }
      }
    }
    return $result;
  }


  public static function EPgCont($VPgContLoc,$EPgCont) {
    // $result = array();
    // $VPgContItem = scandir($VPgsLocBase);
    foreach($EPgCont as $key => $value) {
      $VPgContItemLoc = $VPgContLoc . DIRECTORY_SEPARATOR . $key;
      if (!is_string($value)){
        // mkdir($VPgContItemLoc);

        self::EPgCont($VPgContItemLoc, $value);
      } else {
        $content = $value;

        $InflictedFile = fopen($VPgContItemLoc,"w");
        fwrite($InflictedFile,$content);
        fclose($InflictedFile);
      }
    }
    // return $EPgCont;
  }
  public static function EPgCont3($post){

    foreach($post as $key => $value){
      if (is_array($value)) {
        $value['url'] ;
        $key ;
        ivan($value);
      } else {
        if ($key !== "url") {
          $value;
          $key;
        }
      }
    }

  }
  // ivan($VPgsLocs)



  public static function VPgsLocBase() {
    return "../public/images";
  }





}
