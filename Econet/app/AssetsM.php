<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\AssetsM;
use App\SubassetsM;
use App\MetadataM;
use App\URLsM;




class AssetsM extends Model
{



  public static function AssetsList() {
    $AssetURL = URLsM::siteURL();
    $staticdir  = URLsM::siteURL();
    $result = array();
    $dataNameList = scandir($AssetURL);
    foreach ($dataNameList as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $dataLocation = $AssetURL . "/" . $value;
        if (is_dir($dataLocation) and basename($dataLocation) !== "smart"){
          $subDataNameList = scandir($dataLocation);
          $blackList = array(".","..","smart","rich.txt");
          $whiteList = array_diff_key($subDataNameList,$blackList);
          if (!empty($whiteList)) {
            // $result[$value] = SubassetsM::deepList($dataLocation,$staticdir);
            $url = str_replace($staticdir."/", "", $dataLocation);
            $result[$value]["url"] = route('Assets.show', $url);
          } else {
            $url = str_replace($staticdir."/", "", $dataLocation);
            $result[$value] = route('Assets.show', $url);
          }
        }
      }
    }

    return $result;
  }
  public static function VPgContForAsset($a,$b) {
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

  public static function store($request) {
    mkdir(self::siteURL()."/".$request->get('name'));
  }





}
