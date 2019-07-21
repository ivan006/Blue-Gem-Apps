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
  public static function Show($ShowID) {
    if(!function_exists('App\ShowHelper')){
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

    // $ShowLocation = PostM::ShowLocation($ShowID)."/".$ShowDataID;
    $ShowLocation = PostM::ShowLocation($ShowID);
    // dd($ShowLocation);
    if (is_dir($ShowLocation)) {
      // $Show[$ShowDataID] =   ShowHelper($ShowLocation);
      $Show =   ShowHelper($ShowLocation);
      return $Show;
    }
  }

  public static function Store($ShowLocation, $request, $ShowID) {
    function StoreHelperDestroy($ShowLocation,$ShowDataID, $SelectedSmartDataItem, $SmartDataItemShowFieldValues) {
      foreach ($SmartDataItemShowFieldValues as $key => $value) {
        if (
          $key !== 'SelectedSmartDataItem'
          && $key !== 'SmartDataName'
          && $key !== 'SmartDataLocationParent'
          && $key !== 'SmartDataContent'
          && $key !== 'SmartDataLocation'
        ) {
          if (!isset($value['SmartDataContent'])) {
            // dd(1);
            if (isset($value['SelectedSmartDataItem']) OR $SelectedSmartDataItem == 1) {
              $SelectedSmartDataItemInheritance = 1;
            } else {
              $SelectedSmartDataItemInheritance = 0;
            }
            StoreHelperDestroy($ShowLocation,$ShowDataID."/".$key, $SelectedSmartDataItemInheritance, $value);
            if (isset($value['SelectedSmartDataItem']) OR $SelectedSmartDataItem == 1) {
              rmdir($ShowLocation.$ShowDataID."/".$key);
            }
          } else {

            if (isset($value['SelectedSmartDataItem']) OR $SelectedSmartDataItem == 1) {
              // dd($value['SelectedSmartDataItem']);
              unlink($ShowLocation.$ShowDataID."/".$key);
            }
          }
        }
      }

    }
    function StoreHelperStore($ShowLocation,$SelectedSmartDataItem,$ShowDataID,$SmartDataItemShowFieldValues) {
      // dd($SmartDataItemShowFieldValues);
      foreach($SmartDataItemShowFieldValues as $key => $value) {
        if (
          $key !== 'SelectedSmartDataItem'
          && $key !== 'SmartDataName'
          && $key !== 'SmartDataLocationParent'
          && $key !== 'SmartDataContent'
          && $key !== 'SmartDataLocation'
        )  {
          if (!isset($value['SmartDataContent'])){
            $SmartDataName = $value['SmartDataName'];
            $SmartDataArrayLocation = $ShowLocation . $ShowDataID."/".$SmartDataName;
            if (isset($value['SelectedSmartDataItem']) OR $SelectedSmartDataItem == 1) {
              $SelectedSmartDataItemInheritance = 1;
              mkdir($SmartDataArrayLocation);
            } else {
              $SelectedSmartDataItemInheritance = 0;
            }
            StoreHelperStore($ShowLocation,$SelectedSmartDataItemInheritance, $ShowDataID."/".$SmartDataName, $value);
          } else {
            $SmartDataName = $value['SmartDataName'];
            $content = $value;
            $SmartDataArrayLocation = $ShowLocation."/".$ShowDataID."/".$SmartDataName;


            if (isset($value['SelectedSmartDataItem']) OR $SelectedSmartDataItem == 1) {
              file_put_contents($SmartDataArrayLocation,$value['SmartDataContent']);
            }
          }
        }
      }
    }
    $SmartDataItemM_ShowActions = SmartDataItemM::ShowActions();
    $SmartDataRelativeLocation = base64_decode($request->get($SmartDataItemM_ShowActions['SelectedSmartDataItem']));
    $SmartDataBaseLocation = SmartDataArrayM::ShowBaseLocation();
    $ShowDataID = $SmartDataBaseLocation.$SmartDataRelativeLocation;

    $SmartDataItemShowFieldValues = $request->get("SmartDataItemShowFieldValues");

    $ShowDataLocation = $ShowLocation."/".$ShowDataID;

    StoreHelperDestroy($ShowLocation,null, 0, $SmartDataItemShowFieldValues);

    $SmartDataItemM_ShowAttributeTypes = SmartDataItemM::ShowAttributeTypes();
    $SmartDataItemM_ShowActions = SmartDataItemM::ShowActions();

    StoreHelperStore($ShowLocation, null,null,$SmartDataItemShowFieldValues);
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
      StoreHelperDestroy($ShowLocation);
      // mkdir($ShowLocation.array_keys($SmartDataArray)[0]);


      // mkdir($ShowLocation.SmartDataArrayM::ShowBaseLocation());
      StoreHelperStore($ShowLocation,$SmartDataArray2);

    }
    // return $SmartDataArray;
  }




}
