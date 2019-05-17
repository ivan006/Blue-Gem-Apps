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
      // menu start
        if (1==1) {
          $VPgsLocsForBase = blogM::VPgsLocsForBase();
        }
      // menu end

      $page_tools = blogM::page_tools(null, null);


      return view('browse', compact('page_tools', 'VPgsLocsForBase'));
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

        $VPgContLoc = blogM::VPgContLoc($a,$b);

        $s = "/";
        $filename =  $request->get('file');
        $file =  $VPgContLoc.$s.$filename;
        // echo file_get_contents($file);

        $contents =  $request->get('contents');
        file_put_contents($file,$contents);
      }

      $page_tools = blogM::page_tools($a,$b);

      if (1==1) {
        $VPgCont = blogM::VPgContForBase($a,$b);

        $EPgCont =  json_decode($request->get('smart'));
        blogM::EPgCont($VPgContLoc, $EPgCont);

        // $thing = blogM::EPgCont2($VPgContLoc, $VPgCont);
        // echo "<pre>";
        // var_dump($thing);
        // echo "</pre>";
      }



      return redirect('/'.$page_tools['edit']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($a=null, $b=null){
      // menu start
        if (1==1) {

          $VPgsLocsForBase = blogM::VPgsLocsForBase();
        }
      // menu end
      if (1==1) {

        $VPgCont = blogM::VPgContForBase($a,$b);

        $VSiteHeader = blogM::VPgCont(blogM::VPgsLocBase());
        $VSiteHeader = $VSiteHeader['header.html'];



      }


      // $dir = blogM::VPgModes($a,$b)["dir"];
      // $dir2 = blogM::VPgModes($a,$b)["dir2"];


      $page_tools = blogM::page_tools($a,$b);
      $general_tools = blogM::general_tools();

      return view('view', compact('VPgCont','VPgsLocsForBase', 'a', 'b', 'page_tools', 'VSiteHeader', 'general_tools'));
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

          $VPgsLocsForBase = blogM::VPgsLocsForBase();


        }
      // menu end
      if (1==1) {


        $VPgCont = blogM::VPgContForBase($a,$b);
      }



      $page_tools = blogM::page_tools($a,$b);
      $general_tools = blogM::general_tools();


      return view('edit', compact('VPgCont','VPgsLocsForBase', 'a', 'b', 'general_tools', 'page_tools'));
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
