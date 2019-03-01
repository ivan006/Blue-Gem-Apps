<?php

namespace App\Http\Middleware;

use Closure;

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

          preg_match_all( '/\[r\](.*)\[\/r\]/', $responceContent, $matches);
          // if (isset($matches[0][0])) {
          if (!empty($matches[0])) {
            // if (1==1) {
            //   $shortcode = $matches[0][0];
            //   $parameter = str_replace("[r]", "", $shortcode);
            //   $parameter = str_replace("[/r]", "", $parameter);
            //
            //   $retrieval_path = "http://b-blog.test/view-api/".$parameter;
            //
            //   $result = file_get_contents($retrieval_path);
            //
            //   if ($result !== "[]") {
            //     $content = str_replace($shortcode, $result, $responceContent);
            //     $responce->setContent($content);
            //   }
            // }

            // echo "<pre>";
            // var_dump($matches[0]);
            // echo "</pre>";

            foreach ($matches[0] as $key => $value) {
              $shortcode = $value;
              $parameter = str_replace("[r]", "", $shortcode);
              $parameter = str_replace("[/r]", "", $parameter);

              $retrieval_path = "http://b-blog.test/blogApi/".$parameter;

              $result = file_get_contents($retrieval_path);


              if ($result !== "[]") {
                $result = json_decode($result);

                $responceContent = str_replace($shortcode, $result, $responceContent);
              }

            }
            $responce->setContent($responceContent);



          }
          return $responce;
        }


    }
}
