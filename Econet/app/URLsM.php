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

  public static function ShowAll() {

    if (!empty(func_get_args()[0])) {

      $AssetURLSuffix = AssetsM::ShowID(func_get_args()[0]);
      $SubAssetURLSuffix = SubassetsM::ShowID(func_get_args()[0]);
      $allURLs['sub_assets_read'] =   route('Assets.show',$AssetURLSuffix.$SubAssetURLSuffix);
      $allURLs['sub_assets_edit'] = route('Assets.edit',$AssetURLSuffix.$SubAssetURLSuffix);

      // $allURLs['sub_assets_update'] = route('Assets.update',$AssetURLSuffix.$SubAssetURLSuffix);
      $allURLs['sub_assets_destroy'] = route('Assets.destroy',$AssetURLSuffix.$SubAssetURLSuffix);
      $allURLs['sub_assets_store'] = route('Assets.store',$AssetURLSuffix.$SubAssetURLSuffix);
      $allURLs['sub_assets_create'] = route('Assets.create');
      // $allURLs['sub_assets_index'] = route('Assets.index',$AssetURLSuffix.$SubAssetURLSuffix);


      // $allURLs['assets_read'] =   route('Assets.show',AssetsM::ShowID(func_get_args()[0]));
      // $allURLs['assets_edit'] = route('Assets.edit',AssetsM::ShowID(func_get_args()[0]));
      // $allURLs['assets_update'] = route('Assets.update',AssetsM::ShowID(func_get_args()[0]));
      // $allURLs['assets_destroy'] = route('Assets.destroy',AssetsM::ShowID(func_get_args()[0]));

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



  public static function BaseLocation() {
    return "../storage/app/";
  }



}
