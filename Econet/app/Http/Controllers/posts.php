<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\postsM;
use App\groupsM;

class posts extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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

        $postURL = postsM::postURL($a,$b);

        $s = "/";
        $filename =  $request->get('file');
        $file =  $postURL.$s.$filename;
        // echo file_get_contents($file);

        $contents =  $request->get('contents');
        file_put_contents($file,$contents);
      }



      if (1==1) {
        $postDeepRead = postsM::postDeepRead($a,$b);

        $EPgCont =  json_decode($request->get('smart'));
        postsM::EPgCont($postURL, $EPgCont);


      }

      $allURLs = postsM::allURLs($a,$b);

      return redirect($allURLs['posts_update']);
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

          $postsDeepList = postsM::postsDeepList($a,$b);
        }
      // menu end
      if (1==1) {

        $postDeepRead = postsM::postDeepRead($a,$b);

        $VSiteHeader = postsM::deepRead(groupsM::groupURL());
        $VSiteHeader = $VSiteHeader['header.html'];



      }





      $allURLs = postsM::allURLs($a,$b);

      return view('view', compact('postDeepRead','postsDeepList', 'a', 'b', 'VSiteHeader', 'allURLs'));
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

          $postsDeepList = postsM::postsDeepList($a,$b);


        }
      // menu end
      if (1==1) {


        $postDeepRead = postsM::postDeepRead($a,$b);
      }



      $allURLs = postsM::allURLs($a,$b);


      return view('edit', compact('postDeepRead','postsDeepList', 'a', 'b', 'allURLs'));
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
