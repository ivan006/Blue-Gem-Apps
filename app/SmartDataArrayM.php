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
  public static function Show($ShowDataID, $ShowID) {
    if(!function_exists('App\ShowAllDeepSmartDataHelper')){
      function ShowHelper($ShowLocation) {
        $result = array();
        $shallowList = scandir($ShowLocation);
        foreach ($shallowList as $key => $value) {
          if (!in_array($value,array(".","..")))  {
            $DataLocation = $ShowLocation . "/" . $value;
            if (is_dir($DataLocation)){
              $result[$value] = ShowHelper($DataLocation);
            } else {
              $result[$value] = file_get_contents($DataLocation);
            }
          }
        }
        return  $result;
      }
    }

    $ShowLocation = PostM::ShowLocation($ShowID)."/".$ShowDataID;
    // dd($ShowLocation);
    if (is_dir($ShowLocation)) {
      return  ShowHelper($ShowLocation);
    }
  }

  public static function Store($ShowLocation, $request, $ShowID) {

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
    function StoreHelperStore($ShowDataLocation,$ShowAllDeepSmartData) {
      if (!file_exists($ShowDataLocation)) {
        mkdir($ShowDataLocation);
      }
      // dd ($ShowDataLocation);
      foreach($ShowAllDeepSmartData as $key => $value) {
        $SmartDataArrayLocation = $ShowDataLocation ."/". $key;

        $hrhrhrhr[1]=$SmartDataArrayLocation;
        $hrhrhrhr[2]=$ShowDataLocation;
        $hrhrhrhr[3]=$key;
        dd($hrhrhrhr);
        if (!is_string($value)){
          if (!file_exists($SmartDataArrayLocation)) {
            mkdir($SmartDataArrayLocation);
          }
          StoreHelperStore($SmartDataArrayLocation, $value);
        } else {
          $content = $value;

          file_put_contents($SmartDataArrayLocation,$value);


        }
      }

    }
    // dd($request);
    $SmartDataItemM_ShowActions = SmartDataItemM::ShowActions();
    $SmartDataRelativeLocation = base64_decode($request->get($SmartDataItemM_ShowActions['DeepSmartDataArrayStore']));
    $SmartDataBaseLocation = SmartDataArrayM::ShowBaseLocation();
    $ShowDataID = $SmartDataBaseLocation.$SmartDataRelativeLocation;

    $ShowAllDeepSmartData = SmartDataArrayM::Show($ShowDataID, $ShowID);
    // dd($ShowAllDeepSmartData);

    $ShowDataLocation = $ShowLocation."/".$ShowDataID;
    // dd($ShowDataLocation);

    // if (!empty($ShowDataLocation)) {
      // $SmartDataArray2['smart'] = $SmartDataArray;
      StoreHelperDestroy($ShowDataLocation);

      $SmartDataItemM_ShowAttributeTypes = SmartDataItemM::ShowAttributeTypes();
      $SmartDataItemM_ShowActions = SmartDataItemM::ShowActions();
      StoreHelperStore($ShowDataLocation,$ShowAllDeepSmartData, $SmartDataItemM_ShowAttributeTypes, $SmartDataItemM_ShowActions);

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
          dd ($SmartDataArrayLocation);
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

      $SmartDataArray2['smart'] = $SmartDataArray;
      // dd($SmartDataArray2);
      // dd($ShowLocation);
      StoreHelperDestroy($ShowLocation."/".SmartDataArrayM::ShowBaseLocation());
      // mkdir($ShowLocation.array_keys($SmartDataArray)[0]);


      // mkdir($ShowLocation.SmartDataArrayM::ShowBaseLocation());
      StoreHelperStore($ShowLocation,$SmartDataArray2);

    }
    // return $SmartDataArray;
  }




}
