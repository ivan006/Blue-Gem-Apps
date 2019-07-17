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
    //
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
    $SmartDataRelativeLocationNew = SmartDataAttribute("/SmartDataName",$request);
    $SmartDataNewContent = SmartDataAttribute("/SmartDataContent",$request);
    $SmartDataLocationParent = SmartDataAttribute("/SmartDataLocation",$request);

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
