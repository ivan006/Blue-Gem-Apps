<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\NetworkM;
use App\WebDocM;
use App\SmartDataM;



class SmartDataGroupM extends Model
{

  public static function ShowActions() {
    //
    // if (!empty(func_get_args()[0])) {
    //
    //
    //   $ShowID = WebDocM::ShowID(func_get_args()[0]);
    //   $allURLs['sub_webdoc_read'] =   route('WebDoc.show',$ShowID);
    //   $allURLs['sub_webdoc_edit'] = route('WebDoc.edit',$ShowID);
    //
    //
    //   $allURLs['sub_webdoc_destroy'] = route('WebDoc.destroy',$ShowID);
    //   $allURLs['sub_webdoc_store'] = route('WebDoc.store',$ShowID);
    //   $allURLs['sub_webdoc_create'] = route('WebDoc.create');
    //
    //
    //
    //   $allURLs['webdoc_create'] = route('WebDoc.create');
    //   $allURLs['webdoc_index'] = route('WebDoc.index');
    // } else {
    //   $allURLs['sub_webdoc_read'] =   " ";
    //   $allURLs['sub_webdoc_edit'] = " ";
    //
    //   $allURLs['sub_webdoc_destroy'] =  " ";
    //   $allURLs['sub_webdoc_create'] =  " ";
    //
    //
    // }
    //
    // return $allURLs;
  }

  public static function Store($ShowLocation,$EPgCont) {
    function StoreHelperDestroy($dir) {
      if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
          if ($object != "." && $object != "..") {
            if (is_dir($dir."/".$object))
            StoreHelperDestroy($dir."/".$object);
            else
            unlink($dir."/".$object);
          }
        }
        rmdir($dir);
      }
    }
    function StoreHelperStore($ShowLocation,$EPgCont) {
      // dd($ShowLocation.array_keys($EPgCont)[0]);
      // dd(array_keys($EPgCont)[0]);
      // dd($EPgCont);
      // kk

      foreach($EPgCont as $key => $value) {
        $DataLocation = $ShowLocation ."/". $key;
        if (!is_string($value)){
          // mkdir($ShowLocation.array_keys($EPgCont)[0]);
          mkdir($DataLocation);

          StoreHelperStore($DataLocation, $value);
        } else {
          $content = $value;


          file_put_contents($DataLocation,$value);


        }
      }

    }
    // $result = array();
    // $shallowList = scandir($ShowLocation);
    if (!empty($EPgCont)) {


      // dd($ShowLocation);
      StoreHelperDestroy($ShowLocation."/smart");
      // mkdir($ShowLocation.array_keys($EPgCont)[0]);

      $EPgCont2['smart'] = $EPgCont;
      // mkdir($ShowLocation."smart");
      StoreHelperStore($ShowLocation,$EPgCont2);

    }
    // return $EPgCont;
  }




}
