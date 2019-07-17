<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\NetworkM;
use App\PostM;
use App\SmartDataItemM;
use App\SmartDataArrayM;



class SmartDataArrayM extends Model
{


  public static function ShowBaseLocation() {
    return "smart";
  }
  public static function ShowActions() {

    // if (!empty(func_get_args()[0])) {
    //
    //
    //   $ShowID = PostM::ShowID(func_get_args()[0]);
    //   $allURLs['sub_post_read'] =   route('Post.show',$ShowID);
    //   $allURLs['sub_post_edit'] = route('Post.edit',$ShowID);
    //
    //
    //   $allURLs['sub_post_destroy'] = route('Post.destroy',$ShowID);
    //   $allURLs['sub_post_store'] = route('Post.store',$ShowID);
    //   $allURLs['sub_post_create'] = route('Post.create');
    //
    //
    //
    //   $allURLs['post_create'] = route('Post.create');
    //   $allURLs['post_index'] = route('Post.index');
    // } else {
    //   $allURLs['sub_post_read'] =   " ";
    //   $allURLs['sub_post_edit'] = " ";
    //
    //   $allURLs['sub_post_destroy'] =  " ";
    //   $allURLs['sub_post_create'] =  " ";
    //
    //
    // }

    return $allURLs;
  }

  public static function Store() {
    dd(1111122);
    // function StoreHelperDestroy($dir) {
    //   if (is_dir($dir)) {
    //     $objects = scandir($dir);
    //     foreach ($objects as $object) {
    //       if ($object != "." && $object != "..") {
    //         if (is_dir($dir."/".$object))
    //         StoreHelperDestroy($dir."/".$object);
    //         else
    //         unlink($dir."/".$object);
    //       }
    //     }
    //     rmdir($dir);
    //   }
    // }
    // function StoreHelperStore($ShowLocation,$SmartDataArray) {
    //
    //   foreach($SmartDataArray as $key => $value) {
    //     $SmartDataArrayLocation = $ShowLocation ."/". $key;
    //     if (!is_string($value)){
    //
    //       mkdir($SmartDataArrayLocation);
    //
    //       StoreHelperStore($SmartDataArrayLocation, $value);
    //     } else {
    //       $content = $value;
    //
    //
    //       file_put_contents($SmartDataArrayLocation,$value);
    //
    //
    //     }
    //   }
    //
    // }
    //
    // if (!empty($SmartDataArray)) {
    //
    //   StoreHelperDestroy($ShowLocation."/".SmartDataArrayM::ShowBaseLocation());
    //
    //   $SmartDataArray2['smart'] = $SmartDataArray;
    //
    //   StoreHelperStore($ShowLocation,$SmartDataArray2);
    //
    // }

  }
  public static function StoreFromSingleField($ShowLocation,$SmartDataArray) {
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
    function StoreHelperStore($ShowLocation,$SmartDataArray) {
      // dd($ShowLocation.array_keys($SmartDataArray)[0]);
      // dd(array_keys($SmartDataArray)[0]);
      // dd($SmartDataArray);
      // kk

      foreach($SmartDataArray as $key => $value) {
        $SmartDataArrayLocation = $ShowLocation ."/". $key;
        if (!is_string($value)){
          // mkdir($ShowLocation.array_keys($SmartDataArray)[0]);
          mkdir($SmartDataArrayLocation);

          StoreHelperStore($SmartDataArrayLocation, $value);
        } else {
          $content = $value;


          file_put_contents($SmartDataArrayLocation,$value);


        }
      }

    }
    // $result = array();
    // $shallowList = scandir($ShowLocation);
    if (!empty($SmartDataArray)) {


      // dd($ShowLocation);
      StoreHelperDestroy($ShowLocation."/".SmartDataArrayM::ShowBaseLocation());
      // mkdir($ShowLocation.array_keys($SmartDataArray)[0]);

      $SmartDataArray2['smart'] = $SmartDataArray;
      // mkdir($ShowLocation.SmartDataArrayM::ShowBaseLocation());
      StoreHelperStore($ShowLocation,$SmartDataArray2);

    }
    // return $SmartDataArray;
  }




}
