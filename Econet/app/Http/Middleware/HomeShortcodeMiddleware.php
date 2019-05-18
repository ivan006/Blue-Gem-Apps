<?php

namespace App\Http\Middleware;

use Closure;
use App\postsM;
use App\groupsM;
use App\toolsM;


class HomeShortcodeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      // example
      // <div class="g-multi-level-dropdown">
      //   <ul>
      //     [page_list]
      //     [twig]
      //     <li>
      //       <a href="[link]">
      //         [name] +
      //       </a>
      //       <ul>
      //         [inner_twig]
      //       </ul>
      //     </li>
      //     [/twig]
      //     [leaf]
      //     <li>
      //       <a href="[link]">
      //         [name]
      //       </a>
      //     </li>
      //     [/leaf]
      //     [/page_list]
      //   </ul>
      // </div>

        $responce = $next($request);
        if (!method_exists($responce, "content")) {
          return $responce;
        } else {


          function page_list($VPgsLocs, $value, $preg_match_all){

            foreach($VPgsLocs as $key => $value2){
              preg_match_all( $preg_match_all, $value, $matches);
              // echo "<pre>";
              // var_dump($matches);
              // echo "</pre>";


              if (is_array($value2)) {

                // $preg_match_all = "/\[link\]/";

                $matches[3][0] = str_replace("[link]", $value2['url'], $matches[3][0]);
                $matches[3][0] = str_replace("[name]", $key, $matches[3][0]);

                 echo  $matches[3][0];
                 // echo  $value2['url'];
                 // echo $key ;
                  page_list($value2, $value, $preg_match_all);
                 echo  $matches[5][0];

              } else {
                if ($key !== "url") {

                  // echo  $value2;
                  // echo $key;
                  $matches[9][0] = str_replace("[name]", $key, $matches[9][0]);
                  $matches[9][0] = str_replace("[link]", $value2, $matches[9][0]);
                  echo  $matches[9][0];
                }
              }
            }
          }



          $responceContent = $responce->content();

          $preg_match_all = "/\[page_list\]((.|\n)*?)\[twig\]((.|\n)*?)\[inner_twig\]((.|\n)*?)\[\/twig\]((.|\n)*?)\[leaf\]((.|\n)*?)\[\/leaf\]((.|\n)*?)\[\/page_list\]/";

          preg_match_all( $preg_match_all, $responceContent, $matches);

          if (!empty($matches[0])) {

            foreach ($matches[0] as $key => $value) {

                $siteURL = groupsM::siteURL();
                $VPgsLocs = postsM::deepList($siteURL,$siteURL);
                ob_start();

                  page_list($VPgsLocs,  $value,$preg_match_all);

                $result = ob_get_contents();
                ob_end_clean();

                $responceContent = str_replace($value, $result, $responceContent);

            }

            $responce->setContent($responceContent);



          }
          return $responce;
        }


    }
    // public function handle($request, Closure $next)
    // {
    //     $responce = $next($request);
    //     if (!method_exists($responce, "content")) {
    //       return $responce;
    //     } else {
    //       $responceContent = $responce->content();
    //
    //       preg_match_all( '/\[r\](.*)\[\/r\]/', $responceContent, $matches);
    //
    //       if (!empty($matches[0])) {
    //
    //
    //         foreach ($matches[0] as $key => $value) {
    //           $shortcode = $value;
    //           $parameter = str_replace("[r]", "", $shortcode);
    //           $parameter = str_replace("[/r]", "", $parameter);
    //
    //           $retrieval_path = url('/')."/blogApi/".$parameter;
    //
    //           $result = file_get_contents($retrieval_path);
    //
    //
    //           if ($result !== "[]") {
    //             $result = json_decode($result);
    //
    //             $responceContent = str_replace($shortcode, $result, $responceContent);
    //           }
    //
    //         }
    //         $responce->setContent($responceContent);
    //
    //
    //
    //       }
    //       return $responce;
    //     }
    //
    //
    // }
}
