<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\AssetsM;
use App\SubassetsM;
use App\MetadataM;
use App\URLsM;




class URLsM extends Model
{

  public static function allURLs() {

    if (!empty(func_get_args()[0])) {

      $AssetURLSuffix = URLsM::AssetURLSuffix(func_get_args()[0]);
      $SubAssetURLSuffix = URLsM::SubAssetURLSuffix(func_get_args()[0]);
      $allURLs['sub_assets_read'] =   route('Assets.show',$AssetURLSuffix.$SubAssetURLSuffix);
      $allURLs['sub_assets_edit'] = route('Assets.edit',$AssetURLSuffix.$SubAssetURLSuffix);

      // $allURLs['sub_assets_update'] = route('Assets.update',$AssetURLSuffix.$SubAssetURLSuffix);
      $allURLs['sub_assets_destroy'] = route('Assets.destroy',$AssetURLSuffix.$SubAssetURLSuffix);
      $allURLs['sub_assets_store'] = route('Assets.store',$AssetURLSuffix.$SubAssetURLSuffix);
      $allURLs['sub_assets_create'] = route('Assets.create');
      // $allURLs['sub_assets_index'] = route('Assets.index',$AssetURLSuffix.$SubAssetURLSuffix);


      // $allURLs['assets_read'] =   route('Assets.show',URLsM::AssetURLSuffix(func_get_args()[0]));
      // $allURLs['assets_edit'] = route('Assets.edit',URLsM::AssetURLSuffix(func_get_args()[0]));
      // $allURLs['assets_update'] = route('Assets.update',URLsM::AssetURLSuffix(func_get_args()[0]));
      // $allURLs['assets_destroy'] = route('Assets.destroy',URLsM::AssetURLSuffix(func_get_args()[0]));

      $allURLs['assets_create'] = route('Assets.create');
      $allURLs['assets_index'] = route('Assets.index');
    } else {
      $allURLs['sub_assets_read'] =   " ";
      $allURLs['sub_assets_edit'] = " ";

      $allURLs['sub_assets_destroy'] =  " ";
      $allURLs['sub_assets_create'] =  " ";


    }

    // dd($allURLs);
    return $allURLs;
  }
  // public static function AssetURLs() {
  //   $AssetURLs['assets_read'] = "";
  //   $AssetURLs['assets_create'] = "add";
  //   $AssetURLs['sub_assets_read_suffix'] = "SubAssets";
  //
  //   return $AssetURLs;
  // }
  public static function SubAssetURLSuffix(){

    // $root= URLsM::siteURL();
    $arguments = func_get_args()[0];
    array_shift($arguments);
    $VPgLoc = '';


    foreach ($arguments as $key => $value) {
      $VPgLoc .= "/".$value;
    }


    return $VPgLoc;

  }
  public static function SubAssetURL() {

    // dd(func_get_args()[0]);
    // echo URLsM::siteURL().URLsM::AssetURLSuffix(func_get_args()[0])."/".URLsM::SubAssetURLSuffix(func_get_args()[0]);

    $arguments = func_get_args()[0];
    array_shift($arguments);
    // var_dump($arguments);
    if (!empty($arguments)) {

      return  URLsM::siteURL().URLsM::AssetURLSuffix(func_get_args()[0]).URLsM::SubAssetURLSuffix(func_get_args()[0]);
    } else {
      return  URLsM::siteURL().URLsM::AssetURLSuffix(func_get_args()[0]);

    }

  }
  public static function AssetURLSuffix(){

    // $VPgLoc = '';
    // foreach (func_get_args()[0] as $key => $value) {
    //   $VPgLoc .= "".$value."/";
    // }

    return func_get_args()[0][0];
  }
  public static function AssetURL() {
    // dd(func_get_args()[0]);
    return URLsM::siteURL().func_get_args()[0];
  }
  // public static function AssetURL($value) {
  //   return URLsM::siteURL()."/".$value;
  // }
  public static function siteURL() {
    return "../storage/app/";
  }



}
