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
    $ShowAttributeTypes['/SmartDataName'] =   '/SmartDataName';
    $ShowAttributeTypes['/SmartDataContent'] =   '/SmartDataContent';
    $ShowAttributeTypes['/SmartDataLocation'] =   '/SmartDataLocation';
    $ShowAttributeTypes['/SmartDataLocationParent'] =   '/SmartDataLocationParent';


    return $ShowAttributeTypes;
  }

  public static function Store($ShowLocation, $request) {
    $SmartDataItemM_ShowAttributeTypes = SmartDataItemM::ShowAttributeTypes();
    $SmartDataItemM_ShowActions = SmartDataItemM::ShowActions();
    function SmartDataAttribute($AttributeTypeCode, $request, $SmartDataItemM_ShowActions){
      $SmartDataRelativeLocationEncoded = $request->get($SmartDataItemM_ShowActions['DeepSmartDataItemStore']);
      $SmartDataAttributeFieldDecoded = base64_decode($SmartDataRelativeLocationEncoded).$AttributeTypeCode;
      $SmartDataAttributeField = base64_encode($SmartDataAttributeFieldDecoded);
      return $SmartDataAttributeValue = $request->get($SmartDataAttributeField);
    }

    $SmartDataRelativeLocation = base64_decode($request->get($SmartDataItemM_ShowActions['DeepSmartDataItemStore']));
    $SmartDataRelativeLocationNew = SmartDataAttribute($SmartDataItemM_ShowAttributeTypes['/SmartDataName'],$request, $SmartDataItemM_ShowActions);
    $SmartDataNewContent = SmartDataAttribute($SmartDataItemM_ShowAttributeTypes['/SmartDataContent'],$request, $SmartDataItemM_ShowActions);
    $SmartDataLocationParent = SmartDataAttribute($ShowAttributeTypes['/SmartDataLocation'],$request, $SmartDataItemM_ShowActions);

    $SmartDataBaseLocation = $ShowLocation."/".SmartDataArrayM::ShowBaseLocation();
    $SmartDataLocation = $SmartDataBaseLocation.$SmartDataRelativeLocation;
    $SmartDataLocationNew = $SmartDataBaseLocation.$SmartDataLocationParent."/".$SmartDataRelativeLocationNew;
    // dd($SmartDataLocationNew);

    // dd($SmartDataLocationNew);
    // if (!is_dir('upload/promotions/' . $month)) {
    //   // dir doesn't exist, make it
    //   mkdir('upload/promotions/' . $month);
    // }
    unlink($SmartDataLocation);
    file_put_contents($SmartDataLocationNew,$SmartDataNewContent);
    // file_put_contents($SmartDataLocationNew,$SmartDataNewContent);

  }



}
