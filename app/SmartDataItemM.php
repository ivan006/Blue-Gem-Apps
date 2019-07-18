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
    $ShowActions['DeepSmartDataItemStore'] =   'DeepSmartDataItemStore';
    $ShowActions['DeepSmartDataArrayStore'] =   'DeepSmartDataArrayStore';
    $ShowActions['ShallowSmartDataStore'] =   'ShallowSmartDataStore';
    $ShowActions['RichDataStore'] =   'RichDataStore';
    $ShowActions['DeepSmartDataArrayStoreFromSingleField'] =   'DeepSmartDataArrayStoreFromSingleField';
    return $ShowActions;
  }
  public static function ShowAttributeTypes() {
    $ShowAttributeTypes['/SmartDataName'] =   'SmartDataName';
    $ShowAttributeTypes['/SmartDataContent'] =   'SmartDataContent';
    $ShowAttributeTypes['/SmartDataLocation'] =   'SmartDataLocation';
    $ShowAttributeTypes['/SmartDataLocationParent'] =   'SmartDataLocationParent';


    return $ShowAttributeTypes;
  }

  public static function Store($ShowLocation, $request) {
    function SmartDataFieldNames($request, $SmartDataItemM_ShowActions, $SmartDataItemM_ShowAttributeTypes){
      $SmartDataRelativeLocation = base64_decode($request->get($SmartDataItemM_ShowActions['DeepSmartDataItemStore']));

      $SmartDataFieldNames["Name"] = base64_encode($SmartDataRelativeLocation."/".$SmartDataItemM_ShowAttributeTypes["/SmartDataName"]);
      $SmartDataFieldNames["Content"] = base64_encode($SmartDataRelativeLocation."/".$SmartDataItemM_ShowAttributeTypes["/SmartDataContent"]);
      $SmartDataFieldNames["Location"] = base64_encode($SmartDataRelativeLocation."/".$SmartDataItemM_ShowAttributeTypes["/SmartDataLocation"]);
      return $SmartDataFieldNames;

    }
    function SmartDataFieldValue($SmartDataFieldNames, $request){
      $SmartDataFieldValue['RelativeLocationNew'] = $request->get($SmartDataFieldNames["Name"]);
      $SmartDataFieldValue['Content'] = $request->get($SmartDataFieldNames["Content"]);
      $SmartDataFieldValue['LocationParent'] = $request->get($SmartDataFieldNames["Location"]);
      return $SmartDataFieldValue;
    }

    $SmartDataItemM_ShowActions = SmartDataItemM::ShowActions();
    $SmartDataItemM_ShowAttributeTypes = SmartDataItemM::ShowAttributeTypes();

    $SmartDataFieldNames =SmartDataFieldNames($request, $SmartDataItemM_ShowActions, $SmartDataItemM_ShowAttributeTypes);
    $SmartDataFieldValue =SmartDataFieldValue($SmartDataFieldNames, $request);

    $SmartDataBaseLocation = $ShowLocation."/".SmartDataArrayM::ShowBaseLocation();
    $SmartDataLocationNew = $SmartDataBaseLocation.$SmartDataFieldValue['LocationParent']."/".$SmartDataFieldValue['RelativeLocationNew'];

    $SmartDataRelativeLocation = base64_decode($request->get($SmartDataItemM_ShowActions['DeepSmartDataItemStore']));
    $SmartDataLocation = $SmartDataBaseLocation.$SmartDataRelativeLocation;

    unlink($SmartDataLocation);
    file_put_contents($SmartDataLocationNew,$SmartDataFieldValue['Content']);
    // file_put_contents($SmartDataLocationNew,$SmartDataFieldValue['Content']);

  }



}
