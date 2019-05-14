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

          preg_match_all( '/\[lp_i1\](.*)\[lp_i2\]\[lp_si1\](.*)\[lp_si2\](.*)\[lp_si3\](.*)\[lp_si4\]\[lp_i3\](.*)\[lp_i4\]/', $responceContent, $matches);

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
                ?>
                <ul>
                <?php foreach($VPgsLocs as $key => $value2){?>

                  <?php if (is_array($value2)) { ?>

                    <li><a href="<?php  echo $value2['url'];  ?>"><?php  echo $key;  ?> <span class="g-resp-sm-hide">+</span></a><?php ivan($value2); ?></li>
                  <?php } else { ?>


                    <?php if ($key !== "url") { ?>


                      <?php  echo $matches[1][0];  ?>
                      <li><a href="<?php  echo $value2;  ?>"><?php  echo $key;  ?></a></li>

                    <?php } ?>
                  <?php } ?>
                <?php }?>
                </ul>


                <?php
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
