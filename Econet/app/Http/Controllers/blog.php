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
        $ViewPagesLocBase = blogM::ViewPagesLocBase();
        $ViewPageContentLoc = $ViewPagesLocBase.blogM::ViewPageLoc($ViewPagesLocBase,$a,$b);

        $s = "/";
        $filename =  $request->get('file');
        $file =  $ViewPageContentLoc.$s.$filename;
        // echo file_get_contents($file);

        $contents =  $request->get('contents');
        file_put_contents($file,$contents);
      }

      $ViewPageLocMode1 = "blog".blogM::ViewPageLoc($ViewPagesLocBase,$a,$b);
      $ViewPageLocMode2 = "blogEdit".blogM::ViewPageLoc($ViewPagesLocBase,$a,$b);

      if (1==1) {
        $ViewPageContent = blogM::ViewPageContent($ViewPageContentLoc);
        blogM::EditPageContent2($ViewPageContentLoc, $ViewPageContent);
      }

      return redirect('/'.$ViewPageLocMode2);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($a=null, $b=null){
      // ViewPagesLocs start
        if (1==1) {
          $ViewPagesLocBase = blogM::ViewPagesLocBase();
          $ViewPagesLocs = blogM::ViewPagesLocs($ViewPagesLocBase,$ViewPagesLocBase);
        }
      // ViewPagesLocs end
      if (1==1) {
        $ViewPageContentLoc = blogM::ViewPagesLocBase().blogM::ViewPageLoc($ViewPagesLocBase,$a,$b);



        $ViewPageContent = blogM::ViewPageContent($ViewPageContentLoc);

      }


      // $dir = blogM::ViewPageModes($a,$b)["dir"];
      // $dir2 = blogM::ViewPageModes($a,$b)["dir2"];
      $ViewPageLocMode1 = "blog".blogM::ViewPageLoc($ViewPagesLocBase,$a,$b);
      $ViewPageLocMode2 = "blogEdit".blogM::ViewPageLoc($ViewPagesLocBase,$a,$b);

      return view('view', compact('ViewPageContent','ViewPagesLocs', 'a', 'b', 'ViewPageLocMode1', 'ViewPageLocMode2'));
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
          $ViewPagesLocBase = blogM::ViewPagesLocBase();

          $ViewPagesLocs = blogM::ViewPagesLocs($ViewPagesLocBase,$ViewPagesLocBase);
        }
      // menu end
      if (1==1) {

        $ViewPageContentLoc = blogM::ViewPagesLocBase().blogM::ViewPageLoc($ViewPagesLocBase,$a,$b);

        $ViewPageContent = blogM::ViewPageContent($ViewPageContentLoc);
      }


      $ViewPageLocMode1 = "blog".blogM::ViewPageLoc($ViewPagesLocBase,$a,$b);
      $ViewPageLocMode2 = "blogEdit".blogM::ViewPageLoc($ViewPagesLocBase,$a,$b);


      return view('edit', compact('ViewPageContent','ViewPagesLocs', 'a', 'b', 'ViewPageLocMode1', 'ViewPageLocMode2'));
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
