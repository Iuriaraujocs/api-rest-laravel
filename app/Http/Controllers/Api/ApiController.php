<?php

/**  author: Iuri Cardoso Araujo
 *   email: iuriaraujoc.eng@gmail.com
 * */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;

class ApiController extends Controller
{
    //
    use ApiResponse;

}



//https://medium.com/@cerwyneliata.c/laravel-generalizing-api-response-error-handling-85646a195fea
//https://laraveldaily.com/laravel-api-errors-and-exceptions-how-to-return-responses/


//$request->wantsJson()    pergunta se a requisição espera json,

// if ( Request::capture()->expectsJson()  )
//      {  return "API Method";  }
//      else
//      {  return "Web Method";     }

// if( $request->is('api/*'))
// ou
// if (starts_with(request()->path(), 'api')) 


//Request::ajax()  ajax mas não api