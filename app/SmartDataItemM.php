<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\NetworkM;
use App\PostM;
use App\SmartDataItemM;
use App\SmartDataArrayM;



class SmartDataItemM extends Model
{

  public static function ShowActions() {
    $ShowActions["DeepSmartDataItemStore"] =   'DeepSmartDataItemStore';
    $ShowActions["DeepSmartDataArrayStore"] =   'DeepSmartDataArrayStore';
    $ShowActions["ShallowSmartDataStore"] =   'ShallowSmartDataStore';
    $ShowActions["RichDataStore"] =   'RichDataStore';
    $ShowActions["DeepSmartDataArrayStoreFromSingleField"] =   'DeepSmartDataArrayStoreFromSingleField';
    return $ShowActions;
  }
  public static function ShowAttributeTypes() {
    $ShowAttributeTypes["/SmartDataName"] =   'SmartDataName';
    $ShowAttributeTypes["/SmartDataContent"] =   'SmartDataContent';
    $ShowAttributeTypes["/SmartDataLocation"] =   'SmartDataLocation';
    $ShowAttributeTypes["/SmartDataLocationParent"] =   'SmartDataLocationParent';


    return $ShowAttributeTypes;
  }

  public static function ShowFieldValues($request, $SmartDataRelativeLocation) {
    // dd($request);
    // StoreSon (another good nam for this function)
    $SmartDataItemM_ShowAttributeTypes = SmartDataItemM::ShowAttributeTypes();
    $SmartDataRelativeLocationEncoded = base64_encode($SmartDataRelativeLocation);

    $ShowFieldValues = $request->get("SmartDataItemShowFieldValues")[$SmartDataRelativeLocationEncoded];
    // dd($ShowFieldValues);
    return $ShowFieldValues;
  }
  public static function StoreFieldValue($ShowLocation, $request, $SmartDataRelativeLocation) {
    $ShowFieldValues = SmartDataItemM::ShowFieldValues($request,$SmartDataRelativeLocation);

    // $ShowLocation = $ShowLocation."/".SmartDataArrayM::ShowBaseLocation();
    $ShowLocation = $ShowLocation;
    $SmartDataLocation = $ShowLocation.$SmartDataRelativeLocation;
    $SmartDataLocationNew = $ShowLocation.$ShowFieldValues["SmartDataLocation"]."/".$ShowFieldValues["SmartDataName"];
    if (file_exists($SmartDataLocation)) {
      unlink($SmartDataLocation);
    }
    file_put_contents($SmartDataLocationNew,$ShowFieldValues["SmartDataContent"]);
    // file_put_contents($SmartDataLocationNew,$ShowFieldValues["SmartDataContent"]);
  }
  public static function Store($ShowLocation, $request) {

    $SmartDataItemM_ShowActions = SmartDataItemM::ShowActions();
    $SmartDataRelativeLocation = base64_decode($request->get($SmartDataItemM_ShowActions["DeepSmartDataItemStore"]));
    // dd($SmartDataRelativeLocation);
    SmartDataItemM::StoreFieldValue($ShowLocation, $request, $SmartDataRelativeLocation);
  }



}
