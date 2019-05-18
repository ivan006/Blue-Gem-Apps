<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\postsM;
use App\groupsM;
use App\toolsM;

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
          $postsDeepRead = postsM::postsDeepRead();
        }
      // menu end

      $group_tools = toolsM::group_tools();


      return view('browse', compact('group_tools', 'postsDeepRead'));
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

        $VPgContLoc = postsM::VPgContLoc($a,$b);

        $s = "/";
        $filename =  $request->get('file');
        $file =  $VPgContLoc.$s.$filename;
        // echo file_get_contents($file);

        $contents =  $request->get('contents');
        file_put_contents($file,$contents);
      }

      $post_tools = toolsM::post_tools($a,$b);

      if (1==1) {
        $postDeepList = postsM::postDeepList($a,$b);

        $EPgCont =  json_decode($request->get('smart'));
        postsM::EPgCont($VPgContLoc, $EPgCont);


      }



      return redirect('/'.$post_tools['edit']);
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

          $postsDeepRead = postsM::postsDeepRead($a,$b);
        }
      // menu end
      if (1==1) {

        $postDeepList = postsM::postDeepList($a,$b);

        $VSiteHeader = postsM::deepList(groupsM::groupURL());
        $VSiteHeader = $VSiteHeader['header.html'];



      }





      $post_tools = toolsM::post_tools($a,$b);
      $group_tools = toolsM::group_tools();

      return view('view', compact('postDeepList','postsDeepRead', 'a', 'b', 'post_tools', 'VSiteHeader', 'group_tools'));
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

          $postsDeepRead = postsM::postsDeepRead($a,$b);


        }
      // menu end
      if (1==1) {


        $postDeepList = postsM::postDeepList($a,$b);
      }



      $post_tools = toolsM::post_tools($a,$b);
      $group_tools = toolsM::group_tools();


      return view('edit', compact('postDeepList','postsDeepRead', 'a', 'b', 'group_tools', 'post_tools'));
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
