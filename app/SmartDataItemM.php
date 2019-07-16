<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\NetworkM;
use App\WebDocM;
use App\SmartDataItemM;
use App\SmartDataArrayM;



class SmartDataItemM extends Model
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

  public static function Store($ShowLocation, $request) {

    function SmartDataAttribute($AttributeTypeCode, $request){
      $SmartDataRelativeLocationEncoded = $request->get('Store');
      $SmartDataAttributeFieldDecoded = base64_decode($SmartDataRelativeLocationEncoded).$AttributeTypeCode;
      $SmartDataAttributeField = base64_encode($SmartDataAttributeFieldDecoded);
      return $SmartDataAttributeValue = $request->get($SmartDataAttributeField);
    }

    $SmartDataRelativeLocation = base64_decode($request->get('Store'));
    // dd($SmartDataRelativeLocation);
    $SmartDataRelativeLocationNew = SmartDataAttribute("/SmartDataName",$request);
    // dd($SmartDataRelativeLocationNew);
    $SmartDataNewContent = SmartDataAttribute("/SmartDataContent",$request);
    // dd($SmartDataNewContent);

    $SmartDataBaseLocation = $ShowLocation."/".SmartDataArrayM::ShowBaseLocation();
    $SmartDataLocation = $SmartDataBaseLocation.$SmartDataRelativeLocation;
    $SmartDataLocationNew = $SmartDataBaseLocation.$SmartDataRelativeLocationNew;
    // dd($SmartDataLocationNew);
    // if (!is_dir('upload/promotions/' . $month)) {
    //   // dir doesn't exist, make it
    //   mkdir('upload/promotions/' . $month);
    // }
    unlink($SmartDataLocation);
    file_put_contents($SmartDataLocation,$SmartDataLocationNew);
    // file_put_contents($SmartDataLocationNew,$SmartDataNewContent);

  }



}
