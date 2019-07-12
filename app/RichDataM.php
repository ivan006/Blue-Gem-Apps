<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\NetworkM;
use App\PostM;
use App\SmartDataM;



class RichDataM extends Model
{

  public static function Show(){
    $stuff = PostM::ShowLocation(func_get_args()[0])."/"."rich.txt";
    if (file_exists($stuff)) {
      return  file_get_contents($stuff);;
    }
  }


}
