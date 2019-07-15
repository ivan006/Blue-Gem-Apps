<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\NetworkM;
use App\WebDocM;
use App\SmartDataM;



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

    dd($request);
    // dd(rawurldecode($request->get('Store')));

    // $thing =rawurlencode("/sddddddddd/1/surname.txt");
    // $thing =rawurldecode($thing);
    // $thing =rawurldecode("%2Fsddddddddd%2F1%2Fsurname_txt%2FSmartDataArrayName");
    // $thing =rawurlencode($request->get('Store')."/SmartDataArrayName");
    // dd($thing);
    // dd($request->get($thing));
  }



}
