<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blogM extends Model
{
  public static function ViewPageLoc($ViewPagesLocBase,$a,$b){
    $s = "/";
    $root= $ViewPagesLocBase;
    if (isset($b)) {
      $ViewPageLoc = $s.$a.$s.$b;
      if (is_dir($root.$ViewPageLoc)) {
        return $ViewPageLoc;
      } else {
        return null;
      }
    } elseif (isset($a)) {
      $ViewPageLoc = $s.$a;
      if (is_dir($root.$ViewPageLoc)) {
        return $ViewPageLoc;
      } else {
        return null;
      }
    } else {
      return  null;
    }
  }






  public static function ViewPageContent($ViewPagesLocBase) {
    $result = array();
    $ViewPageContentItem = scandir($ViewPagesLocBase);
    foreach ($ViewPageContentItem as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $ViewPageContentItemLoc = $ViewPagesLocBase . DIRECTORY_SEPARATOR . $value;
        if (is_dir($ViewPageContentItemLoc)){
          $result[$value] = self::ViewPageContent($ViewPageContentItemLoc);
        } else {
          $result[$value] = file_get_contents($ViewPageContentItemLoc);
        }
      }
    }
    return  $result;
  }

  public static function ViewPagesLocs($ViewPagesLocBase,$staticdir) {
    $result = array();
    $ViewPageContentItem = scandir($ViewPagesLocBase);
    foreach ($ViewPageContentItem as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $ViewPageContentItemLoc = $ViewPagesLocBase . DIRECTORY_SEPARATOR . $value;
        if (is_dir($ViewPageContentItemLoc) and basename($ViewPageContentItemLoc) !== "smart"){
          $ViewPageContentItemSubLoc = scandir($ViewPageContentItemLoc);
          $a1 = array(".","..","smart","rich.txt");
          $dif = array_diff_key($ViewPageContentItemSubLoc,$a1);
          if (!empty($dif)) {
            $result[$value] = self::ViewPagesLocs($ViewPageContentItemLoc,$staticdir);
            $url = str_replace($staticdir."/", "", $ViewPageContentItemLoc);
            $result[$value]["url"] = url('/')."/blog/".$url;
          } else {
            $url = str_replace($staticdir."/", "", $ViewPageContentItemLoc);
            $result[$value] = url('/')."/blog/".$url;
          }
        }
      }
    }
    return $result;
  }

  public static function EditPageContent($ViewPagesLocBase) {
    $result = array();
    $ViewPageContentItem = scandir($ViewPagesLocBase);
    foreach ($ViewPageContentItem as $key => $value) {
      $ViewPageContentItemLoc = $ViewPagesLocBase . DIRECTORY_SEPARATOR . $value;
      if (!in_array($value,array(".","..")))  {
        if (is_dir($ViewPageContentItemLoc)){
          $result[$value] = self::ViewPageContent($ViewPageContentItemLoc);
        } else {
          $result[$value] = file_get_contents($ViewPageContentItemLoc);
        }
      }
    }
    return  $result;
  }
  public static function EditPageContent2($ViewPageContentLoc,$ViewPageContent) {


    $result = array();
    // $ViewPageContentItem = scandir($ViewPagesLocBase);

    foreach($ViewPageContent as $ViewPageContentItem) {
      // $ViewPageContentItemLoc = $ViewPageContentLoc . DIRECTORY_SEPARATOR . $ViewPageContentItem;
      $ViewPageContentItemLoc = $ViewPageContentLoc . DIRECTORY_SEPARATOR . key($ViewPageContentItem);
      if (is_array($ViewPageContentItemLoc)){
        mkdir($ViewPageContentItemLoc);

        self::EditPageContent2($ViewPageContentLoc, $ViewPageContentItem);

      } elseif (is_string($ViewPageContentItemLoc) or is_numeric($ViewPageContentItemLoc))  {
        if (1==1) {


          $content = "some text here";
          fwrite(fopen($ViewPageContentItemLoc,"wb"),$content);
          fclose(fopen($ViewPageContentItemLoc,"wb"));
        }

      }

    }
  }



  public static function ViewPagesLocBase() {
    return "../public/images";
  }





}
