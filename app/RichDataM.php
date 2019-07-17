<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\NetworkM;
use App\PostM;
use App\SmartDataItemM;
use App\SmartDataArrayM;



class RichDataM extends Model
{

  public static function Show(){
    $ShowID = PostM::ShowID(func_get_args()[0]);
    $stuff = PostM::ShowLocation($ShowID)."/"."rich.txt";
    if (file_exists($stuff)) {
      return  file_get_contents($stuff);;
    }
  }


}
