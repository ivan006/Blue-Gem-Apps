<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\blogM;

class blog extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $a=null, $b=null)
    {
      if (1==1) {
        $ViewPageContentDir = "../public/images".blogM::ViewPagePath($a,$b);

        $s = "/";
        $filename =  $request->get('file');
        $file =  $ViewPageContentDir.$s.$filename;
        // echo file_get_contents($file);

        $contents =  $request->get('contents');
        file_put_contents($file,$contents);
      }

      $ViewPagePathView = "blog".blogM::ViewPagePath($a,$b);
      $ViewPagePathEdit = "blogEdit".blogM::ViewPagePath($a,$b);
      return redirect('/'.$ViewPagePathEdit);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($a=null, $b=null){
      // ViewPageList start
        if (1==1) {
          $dir = '../public/images';
          $ViewPageList = blogM::ViewPageList($dir);
        }
      // ViewPageList end
      if (1==1) {
        $ViewPageContentDir = "../public/images".blogM::ViewPagePath($a,$b);



        $ViewPageContent = blogM::ViewPageContent($ViewPageContentDir);

      }


      // $dir = blogM::ViewPageModes($a,$b)["dir"];
      // $dir2 = blogM::ViewPageModes($a,$b)["dir2"];
      $ViewPagePathView = "blog".blogM::ViewPagePath($a,$b);
      $ViewPagePathEdit = "blogEdit".blogM::ViewPagePath($a,$b);

      return view('view', compact('ViewPageContent','ViewPageList', 'a', 'b', 'ViewPagePathView', 'ViewPagePathEdit'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($a=null, $b=null){
      // menu start

        if (1==1) {
          $dir = '../public/images';

          $ViewPageList = blogM::ViewPageList($dir);
        }
      // menu end
      if (1==1) {

        $ViewPageContentDir = "../public/images".blogM::ViewPagePath($a,$b);

        $ViewPageContent = blogM::ViewPageContent($ViewPageContentDir);
      }


      $ViewPagePathView = "blog".blogM::ViewPagePath($a,$b);
      $ViewPagePathEdit = "blogEdit".blogM::ViewPagePath($a,$b);


      return view('edit', compact('ViewPageContent','ViewPageList', 'a', 'b', 'ViewPagePathView', 'ViewPagePathEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
