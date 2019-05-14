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
        $responce = $next($request);
        if (!method_exists($responce, "content")) {
          return $responce;
        } else {
          $responceContent = $responce->content();

          preg_match_all( '/\[menu_1\](.*)\[menu_2\](.*)\[menu_3\]\[menu_si_1\](.*)\[menu_si_2\](.*)\[menu_si_3\]\[menu_i_1\](.*)\[menu_i_2\](.*)\[menu_i_3\]/', $responceContent, $matches);

          if (!empty($matches[0])) {


            foreach ($matches[0] as $key => $value) {
              // $shortcode = $value;
              // $parameter = str_replace("[r]", "", $shortcode);
              // $parameter = str_replace("[/r]", "", $parameter);
              //
              // $retrieval_path = url('/')."/blogApi/".$parameter;
              //
              // $result = file_get_contents($retrieval_path);


              // if ($result !== "[]") {
                $VPgsLocBase = blogM::VPgsLocBase();
                $VPgsLocs = blogM::VPgsLocs($VPgsLocBase,$VPgsLocBase);
                ob_start();

                function page_list($VPgsLocs){

                  foreach($VPgsLocs as $key => $value2){
                    if (is_array($value2)) {
                ?>
                      <li><a href="{{$value2['url']}}"><?php echo $key ?> <span class="g-resp-sm-hide">+</span></a><ul><?php page_list($value2); ?></ul></li>
                <?php
                    } else {
                      if ($key !== "url") {
                ?>
                      <li><a href="<?php echo $value2 ?>"><?php echo $key ?></a></li>
                <?php
                      }
                    }
                  }

                }
                page_list($VPgsLocs);

                $result = ob_get_contents();
                ob_end_clean();


                $responceContent = str_replace($value, $result, $responceContent);
              // }

            }
            echo "<pre>";
            // var_dump($matches);
            echo "</pre>";

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
