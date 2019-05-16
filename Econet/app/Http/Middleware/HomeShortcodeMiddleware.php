<?php

namespace App\Http\Middleware;

use Closure;
use App\blogM;


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
      //       <a href="[link]">[name]+</a>
      //       <ul>
      //         [inner_twig]
      //       </ul>
      //     </li>
      //     [/twig]
      //     [leaf]
      //     <li><a href="[link]">[name]</a></li>
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

                 echo  $matches[3][0];
                 echo  $value2['url'];
                 echo  $matches[5][0];
                 echo $key ;
                 echo  $matches[7][0];
                 page_list($value2, $value, $preg_match_all);
                 echo  $matches[9][0];

              } else {
                if ($key !== "url") {

                  echo  $matches[13][0];
                  echo  $value2;
                  echo  $matches[15][0];
                  echo $key;
                  echo  $matches[17][0];
                }
              }
            }

          }

          $responceContent = $responce->content();

          $preg_match_all = "/\[page_list\]((.|\n)*?)\[twig\]((.|\n)*?)\[link\]((.|\n)*?)\[name\]((.|\n)*?)\[inner_twig\]((.|\n)*?)\[\/twig\]((.|\n)*?)\[leaf\]((.|\n)*?)\[link\]((.|\n)*?)\[name\]((.|\n)*?)\[\/leaf\]((.|\n)*?)\[\/page_list\]/";

          preg_match_all( $preg_match_all, $responceContent, $matches);

          if (!empty($matches[0])) {

            foreach ($matches[0] as $key => $value) {

                $VPgsLocBase = blogM::VPgsLocBase();
                $VPgsLocs = blogM::VPgsLocs($VPgsLocBase,$VPgsLocBase);
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
