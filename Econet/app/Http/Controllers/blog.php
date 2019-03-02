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
        $VPgsLocBase = blogM::VPgsLocBase();
        $VPgContLoc = $VPgsLocBase.blogM::VPgLoc($VPgsLocBase,$a,$b);

        $s = "/";
        $filename =  $request->get('file');
        $file =  $VPgContLoc.$s.$filename;
        // echo file_get_contents($file);

        $contents =  $request->get('contents');
        // file_put_contents($file,$contents);
      }

      $VPgLocMode1 = "blog".blogM::VPgLoc($VPgsLocBase,$a,$b);
      $VPgLocMode2 = "blogEdit".blogM::VPgLoc($VPgsLocBase,$a,$b);

      if (1==1) {
        $VPgCont = blogM::VPgCont($VPgContLoc);

        $EPgCont =  json_decode($request->get('smart'));
        blogM::EPgCont($VPgContLoc, $EPgCont);

        // $thing = blogM::EPgCont2($VPgContLoc, $VPgCont);
        // echo "<pre>";
        // var_dump($thing);
        // echo "</pre>";
      }



      return redirect('/'.$VPgLocMode2);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($a=null, $b=null){
      // VPgsLocs start
        if (1==1) {
          $VPgsLocBase = blogM::VPgsLocBase();
          $VPgsLocs = blogM::VPgsLocs($VPgsLocBase,$VPgsLocBase);
        }
      // VPgsLocs end
      if (1==1) {
        $VPgContLoc = blogM::VPgsLocBase().blogM::VPgLoc($VPgsLocBase,$a,$b);



        $VPgCont = blogM::VPgCont($VPgContLoc);

      }


      // $dir = blogM::VPgModes($a,$b)["dir"];
      // $dir2 = blogM::VPgModes($a,$b)["dir2"];
      $VPgLocMode1 = "blog".blogM::VPgLoc($VPgsLocBase,$a,$b);
      $VPgLocMode2 = "blogEdit".blogM::VPgLoc($VPgsLocBase,$a,$b);

      return view('view', compact('VPgCont','VPgsLocs', 'a', 'b', 'VPgLocMode1', 'VPgLocMode2'));
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
          $VPgsLocBase = blogM::VPgsLocBase();

          $VPgsLocs = blogM::VPgsLocs($VPgsLocBase,$VPgsLocBase);
        }
      // menu end
      if (1==1) {

        $VPgContLoc = blogM::VPgsLocBase().blogM::VPgLoc($VPgsLocBase,$a,$b);

        $VPgCont = blogM::VPgCont($VPgContLoc);
      }


      $VPgLocMode1 = "blog".blogM::VPgLoc($VPgsLocBase,$a,$b);
      $VPgLocMode2 = "blogEdit".blogM::VPgLoc($VPgsLocBase,$a,$b);


      return view('edit', compact('VPgCont','VPgsLocs', 'a', 'b', 'VPgLocMode1', 'VPgLocMode2'));
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
