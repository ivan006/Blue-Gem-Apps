+--------+-----------+----------------------------------------------------------+----------------+----------------------------------------+--------------+
| Domain | Method    | URI                                                      | Name           | Action                                 | Middleware   |
+--------+-----------+----------------------------------------------------------+----------------+----------------------------------------+--------------+
|        | GET|HEAD  | /                                                        |                | Closure                                | web,ivans    |
|        | GET|HEAD  | Assets                                                   | Assets.index   | App\Http\Controllers\Assets@index      | web,ivans    |
|        | POST      | Assets                                                   | Assets.store   | App\Http\Controllers\Assets@store      | web,ivans    |
|        | GET|HEAD  | Assets/create                                            | Assets.create  | App\Http\Controllers\Assets@create     | web,ivans    |
|        | PUT|PATCH | Assets/{Asset}                                           | Assets.update  | App\Http\Controllers\Assets@update     | web,ivans    |
|        | GET|HEAD  | Assets/{Asset}                                           | Assets.show    | App\Http\Controllers\Assets@show       | web,ivans    |
|        | DELETE    | Assets/{Asset}                                           | Assets.destroy | App\Http\Controllers\Assets@destroy    | web,ivans    |
|        | GET|HEAD  | Assets/{Asset}/edit                                      | Assets.edit    | App\Http\Controllers\Assets@edit       | web,ivans    |
|        | POST      | SubAssets/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}             | {g?}.store     | App\Http\Controllers\SubAssets@store   | web,ivans    |
|        | GET|HEAD  | SubAssets/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}             | {g?}.index     | App\Http\Controllers\SubAssets@index   | web,ivans    |
|        | GET|HEAD  | SubAssets/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}/create      | {g?}.create    | App\Http\Controllers\SubAssets@create  | web,ivans    |
|        | PUT|PATCH | SubAssets/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}/{{g?}}      | {g?}.update    | App\Http\Controllers\SubAssets@update  | web,ivans    |
|        | DELETE    | SubAssets/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}/{{g?}}      | {g?}.destroy   | App\Http\Controllers\SubAssets@destroy | web,ivans    |
|        | GET|HEAD  | SubAssets/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}/{{g?}}      | {g?}.show      | App\Http\Controllers\SubAssets@show    | web,ivans    |
|        | GET|HEAD  | SubAssets/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}/{{g?}}/edit | {g?}.edit      | App\Http\Controllers\SubAssets@edit    | web,ivans    |
|        | GET|HEAD  | api/user                                                 |                | Closure                                | api,auth:api |
|        | GET|HEAD  | phpversion                                               |                | Closure                                | web          |
+--------+-----------+----------------------------------------------------------+----------------+----------------------------------------+--------------+
