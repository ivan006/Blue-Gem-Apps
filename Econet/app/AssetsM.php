<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\AssetsM;


class AssetsM extends Model
{


  public static function upload($arguments, $request) {

    $AssetURLSuffix = AssetsM::AssetURLSuffix($arguments);
    $SubAssetURLSuffix = AssetsM::SubAssetURLSuffix($arguments);
    $AssetAndSubAssetURLSuffix = $AssetURLSuffix.$SubAssetURLSuffix;


    $request->zip_file->storeAs($AssetAndSubAssetURLSuffix, $request->zip_file->getClientOriginalName());

    $path = "Econet/storage/app/".$AssetAndSubAssetURLSuffix."/".$request->zip_file->getClientOriginalName();
    // dd($path);
    // $Path = public_path($AssetAndSubAssetURLSuffix);

    \Zipper::make($path)->extractTo("Econet/".$AssetAndSubAssetURLSuffix);


  }

  public static function allURLs() {

    if (!empty(func_get_args()[0])) {

      $AssetURLSuffix = AssetsM::AssetURLSuffix(func_get_args()[0]);
      $SubAssetURLSuffix = AssetsM::SubAssetURLSuffix(func_get_args()[0]);
      $allURLs['sub_assets_read'] =   route('Assets.show',$AssetURLSuffix.$SubAssetURLSuffix);
      $allURLs['sub_assets_edit'] = route('Assets.edit',$AssetURLSuffix.$SubAssetURLSuffix);

      // $allURLs['sub_assets_update'] = route('Assets.update',$AssetURLSuffix.$SubAssetURLSuffix);
      $allURLs['sub_assets_destroy'] = route('Assets.destroy',$AssetURLSuffix.$SubAssetURLSuffix);
      $allURLs['sub_assets_store'] = route('Assets.store',$AssetURLSuffix.$SubAssetURLSuffix);
      $allURLs['sub_assets_create'] = route('Assets.create');
      // $allURLs['sub_assets_index'] = route('Assets.index',$AssetURLSuffix.$SubAssetURLSuffix);


      // $allURLs['assets_read'] =   route('Assets.show',AssetsM::AssetURLSuffix(func_get_args()[0]));
      // $allURLs['assets_edit'] = route('Assets.edit',AssetsM::AssetURLSuffix(func_get_args()[0]));
      // $allURLs['assets_update'] = route('Assets.update',AssetsM::AssetURLSuffix(func_get_args()[0]));
      // $allURLs['assets_destroy'] = route('Assets.destroy',AssetsM::AssetURLSuffix(func_get_args()[0]));

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

    // $root= AssetsM::siteURL();
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
    // echo AssetsM::siteURL().AssetsM::AssetURLSuffix(func_get_args()[0])."/".AssetsM::SubAssetURLSuffix(func_get_args()[0]);

    $arguments = func_get_args()[0];
    array_shift($arguments);
    // var_dump($arguments);
    if (!empty($arguments)) {

      return  AssetsM::siteURL().AssetsM::AssetURLSuffix(func_get_args()[0]).AssetsM::SubAssetURLSuffix(func_get_args()[0]);
    } else {
      return  AssetsM::siteURL().AssetsM::AssetURLSuffix(func_get_args()[0]);

    }

  }

  public static function SubAssetDeepRead() {
    return  AssetsM::deepRead(AssetsM::SubAssetURL(func_get_args()[0]));
  }
  public static function deepRead($AssetURL) {
    $result = array();
    $shallowList = scandir($AssetURL);
    foreach ($shallowList as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $VPgContItemLoc = $AssetURL . DIRECTORY_SEPARATOR . $value;
        if (is_dir($VPgContItemLoc)){
          $result[$value] = AssetsM::deepRead($VPgContItemLoc);
        } else {
          $result[$value] = file_get_contents($VPgContItemLoc);
        }
      }
    }
    return  $result;
  }

  public static function SubAssetsDeepList() {
    // $arguments = func_get_args()[0];
    // array_shift($arguments);


    $AssetURLSuffix = AssetsM::AssetURLSuffix(func_get_args()[0]);
    $AssetURL = AssetsM::AssetURL($AssetURLSuffix);
    $staticdir = AssetsM::AssetURL($AssetURLSuffix);
    // dd($staticdir);
    $result[$AssetURLSuffix] = AssetsM::deepList($AssetURL,$staticdir,$AssetURLSuffix);
    // dd($result);

    // $arguments = $request->route()->parameters();
    // // dd($arguments);
    // $AssetURLSuffix = $arguments['a'];
    // $AssetURL = AssetsM::AssetURL($AssetURLSuffix);
    // // dd($AssetURL);
    // $VPgsLocs = AssetsM::deepList($AssetURL,$AssetURL,$AssetURLSuffix);
    // // dd($VPgsLocs);

    return $result;
  }

  public static function deepList($AssetURL,$staticdir,$AssetURLSuffix) {
    $result = array();
    // dd ($AssetURL);
    $dataNameList = scandir($AssetURL);

    $url = str_replace($staticdir, "", $AssetURL);
    $result["url"] = route("Assets.show")."/".$AssetURLSuffix.$url;
    foreach ($dataNameList as $key => $value) {
      if (!in_array($value,array(".","..")))  {
        $dataLocation = $AssetURL . "/" . $value;
        if (is_dir($dataLocation) and basename($dataLocation) !== "smart"){
          $subDataNameList = scandir($dataLocation);
          $blackList = array(".","..","smart","rich.txt");
          $whiteList = array_diff_key($subDataNameList,$blackList);
          if (!empty($whiteList)) {
            $result[$value] = AssetsM::deepList($dataLocation,$staticdir,$AssetURLSuffix);
            // $url = str_replace($staticdir."/", "", $dataLocation);
            // $result[$value]["url"] = route("Assets.show")."/".$AssetURLSuffix."/".$url;
          } else {
            $url = str_replace($staticdir, "", $dataLocation);
            $result[$value] = route("Assets.show")."/".$AssetURLSuffix.$url;
          }
        }
      }
    }
    return $result;
  }

  public static function rrmdir($dir) {
    if (is_dir($dir)) {
      $objects = scandir($dir);
      foreach ($objects as $object) {
        if ($object != "." && $object != "..") {
          if (is_dir($dir."/".$object))
          AssetsM::rrmdir($dir."/".$object);
          else
          unlink($dir."/".$object);
        }
      }
      rmdir($dir);
    }
  }
  public static function StoreSubAsset($SubAssetURL,$EPgCont) {
    // $result = array();
    // $shallowList = scandir($SubAssetURL);
    if (!empty($EPgCont)) {


      // dd($SubAssetURL);
      AssetsM::rrmdir($SubAssetURL."/smart");
      // mkdir($SubAssetURL.array_keys($EPgCont)[0]);

      $EPgCont2['smart'] = $EPgCont;
      // mkdir($SubAssetURL."smart");
      AssetsM::EPgCont($SubAssetURL,$EPgCont2);

    }
    // return $EPgCont;
  }
  public static function EPgCont($SubAssetURL,$EPgCont) {
    // dd($SubAssetURL.array_keys($EPgCont)[0]);
    // dd(array_keys($EPgCont)[0]);
    // dd($EPgCont);
    foreach($EPgCont as $key => $value) {
      $VPgContItemLoc = $SubAssetURL ."/". $key;
      if (!is_string($value)){
        // mkdir($SubAssetURL.array_keys($EPgCont)[0]);
        mkdir($VPgContItemLoc);

        AssetsM::EPgCont($VPgContItemLoc, $value);
      } else {
        $content = $value;


        file_put_contents($VPgContItemLoc,$value);


      }
    }

  }



    public static function AssetsList() {
      $AssetURL = AssetsM::siteURL();
      $staticdir  = AssetsM::siteURL();
      $result = array();
      $dataNameList = scandir($AssetURL);
      foreach ($dataNameList as $key => $value) {
        if (!in_array($value,array(".","..")))  {
          $dataLocation = $AssetURL . "/" . $value;
          if (is_dir($dataLocation) and basename($dataLocation) !== "smart"){
            $subDataNameList = scandir($dataLocation);
            $blackList = array(".","..","smart","rich.txt");
            $whiteList = array_diff_key($subDataNameList,$blackList);
            if (!empty($whiteList)) {
              // $result[$value] = AssetsM::deepList($dataLocation,$staticdir);
              $url = str_replace($staticdir."/", "", $dataLocation);
              $result[$value]["url"] = route('Assets.show', $url);
            } else {
              $url = str_replace($staticdir."/", "", $dataLocation);
              $result[$value] = route('Assets.show', $url);
            }
          }
        }
      }

      return $result;
    }





    public static function VPgContForAsset($a,$b) {
      $result = array();
      $VPgContItem = scandir($siteURL);
      foreach ($VPgContItem as $key => $value) {
        if (!in_array($value,array(".","..")))  {
          $VPgContItemLoc = $siteURL . DIRECTORY_SEPARATOR . $value;

            $result[$value] = file_get_contents($VPgContItemLoc);

        }
      }
      return  $result;
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
      return AssetsM::siteURL().func_get_args()[0];
    }
    // public static function AssetURL($value) {
    //   return AssetsM::siteURL()."/".$value;
    // }
    public static function siteURL() {
      return "../storage/app/";
    }

    public static function store($request) {
      mkdir(self::siteURL()."/".$request->get('name'));
    }






}
