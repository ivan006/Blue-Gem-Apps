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

  public static function SmartDataFieldValue($request, $SmartDataRelativeLocation) {
    dd($request);
    // StoreSon (another good nam for this function)
    $SmartDataItemM_ShowAttributeTypes = SmartDataItemM::ShowAttributeTypes();
    $SmartDataRelativeLocationEncoded = base64_encode($SmartDataRelativeLocation);

    $SmartDataFieldValue = $request->get("SmartFucker")[$SmartDataRelativeLocationEncoded];
    // dd($SmartDataFieldValue);
    return $SmartDataFieldValue;
  }
  public static function Store($ShowLocation, $request) {
    $SmartDataItemM_ShowActions = SmartDataItemM::ShowActions();
    $SmartDataRelativeLocation = base64_decode($request->get($SmartDataItemM_ShowActions["DeepSmartDataItemStore"]));
    // dd($SmartDataRelativeLocation);
    $SmartDataFieldValue = SmartDataItemM::SmartDataFieldValue($request,$SmartDataRelativeLocation);

    $SmartDataBaseLocation = $ShowLocation."/".SmartDataArrayM::ShowBaseLocation();
    $SmartDataLocation = $SmartDataBaseLocation.$SmartDataRelativeLocation;
    $SmartDataLocationNew = $SmartDataBaseLocation.$SmartDataFieldValue["SmartDataLocation"]."/".$SmartDataFieldValue["SmartDataName"];

    unlink($SmartDataLocation);
    file_put_contents($SmartDataLocationNew,$SmartDataFieldValue["SmartDataContent"]);
    // file_put_contents($SmartDataLocationNew,$SmartDataFieldValue["SmartDataContent"]);
  }



}
