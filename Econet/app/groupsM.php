<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\postsM;
use App\groupsM;
use App\toolsM;

class groupsM extends Model
{









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
