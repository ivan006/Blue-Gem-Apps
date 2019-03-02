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

  public static function EPgCont($VPgsLocBase) {
    $result = array();
    $VPgContItem = scandir($VPgsLocBase);
    foreach ($VPgContItem as $key => $value) {
      $VPgContItemLoc = $VPgsLocBase . DIRECTORY_SEPARATOR . $value;
      if (!in_array($value,array(".","..")))  {
        if (is_dir($VPgContItemLoc)){
          $result[$value] = self::VPgCont($VPgContItemLoc);
        } else {
          $result[$value] = file_get_contents($VPgContItemLoc);
        }
      }
    }
    return  $result;
  }
  public static function EPgCont2($VPgContLoc,$VPgCont) {


    $result = array();
    // $VPgContItem = scandir($VPgsLocBase);

    foreach($VPgCont as $VPgContItem) {
      $VPgContItemLoc = $VPgContLoc . DIRECTORY_SEPARATOR . $VPgContItem;
      // $VPgContItemLoc = $VPgContLoc . DIRECTORY_SEPARATOR . key($VPgContItem);
      if (is_array($VPgContItemLoc)){
        mkdir($VPgContItemLoc);

        self::EPgCont2($VPgContLoc, $VPgContItem);

      } elseif (is_string($VPgContItemLoc) or is_numeric($VPgContItemLoc))  {
        if (1==1) {


          $content = "some text here";
          fwrite(fopen($VPgContItemLoc,"wb"),$content);
          fclose(fopen($VPgContItemLoc,"wb"));
        }

      }

    }
  }



  public static function VPgsLocBase() {
    return "../public/images";
  }





}
