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
        $ViewPageContentLocation = blogM::ViewPagesLocationBase().blogM::ViewPageLocation($dir,$a,$b);

        $s = "/";
        $filename =  $request->get('file');
        $file =  $ViewPageContentLocation.$s.$filename;
        // echo file_get_contents($file);

        $contents =  $request->get('contents');
        file_put_contents($file,$contents);
      }

      $ViewPageLocationMode1 = "blog".blogM::ViewPageLocation($dir,$a,$b);
      $ViewPageLocationMode2 = "blogEdit".blogM::ViewPageLocation($dir,$a,$b);
      return redirect('/'.$ViewPageLocationMode2);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($a=null, $b=null){
      // ViewPagesLocations start
        if (1==1) {
          $dir = blogM::ViewPagesLocationBase();
          $ViewPagesLocations = blogM::ViewPagesLocations($dir,$dir);
        }
      // ViewPagesLocations end
      if (1==1) {
        $ViewPageContentLocation = blogM::ViewPagesLocationBase().blogM::ViewPageLocation($dir,$a,$b);



        $ViewPageContent = blogM::ViewPageContent($ViewPageContentLocation);

      }


      // $dir = blogM::ViewPageModes($a,$b)["dir"];
      // $dir2 = blogM::ViewPageModes($a,$b)["dir2"];
      $ViewPageLocationMode1 = "blog".blogM::ViewPageLocation($dir,$a,$b);
      $ViewPageLocationMode2 = "blogEdit".blogM::ViewPageLocation($dir,$a,$b);

      return view('view', compact('ViewPageContent','ViewPagesLocations', 'a', 'b', 'ViewPageLocationMode1', 'ViewPageLocationMode2'));
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
          $dir = blogM::ViewPagesLocationBase();

          $ViewPagesLocations = blogM::ViewPagesLocations($dir,$dir);
        }
      // menu end
      if (1==1) {

        $ViewPageContentLocation = blogM::ViewPagesLocationBase().blogM::ViewPageLocation($dir,$a,$b);

        $ViewPageContent = blogM::ViewPageContent($ViewPageContentLocation);
      }


      $ViewPageLocationMode1 = "blog".blogM::ViewPageLocation($dir,$a,$b);
      $ViewPageLocationMode2 = "blogEdit".blogM::ViewPageLocation($dir,$a,$b);


      return view('edit', compact('ViewPageContent','ViewPagesLocations', 'a', 'b', 'ViewPageLocationMode1', 'ViewPageLocationMode2'));
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
