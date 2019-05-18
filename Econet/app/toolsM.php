<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\postsM;
use App\groupsM;
use App\toolsM;

class toolsM extends Model
{

    public static function post_tools($a,$b) {
      $post_tools['view'] = "blog".postsM::postURLSuffix($a,$b);
      $post_tools['edit'] = "blogEdit".postsM::postURLSuffix($a,$b);

      echo view('post_tools', compact('post_tools'));;
    }
    public static function group_tools() {
      $group_tools['browse_groups'] = "groups";
      $group_tools['add'] = "add";

      echo view('group_tools', compact('group_tools'));;
    }
}
