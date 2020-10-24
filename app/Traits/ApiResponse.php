<?php

/**  author: Iuri Cardoso Araujo
 *   email: iuriaraujoc.eng@gmail.com
 * */

namespace App\Traits;

trait ApiResponse{

	//All went well, and (usually) some data was returned
    protected function successResponse($data = null, $message = null, $code = 200){

		return response()->json($this->generalResponse('success', $code, null, $message, $data), $code);
	}

	//An error occurred in processing the request, i.e. an exception was thrown
	protected function errorResponse($error = null, $code = 500){

		return response()->json($this->generalResponse('error', $code, $error), $code);
	}

	//There was a problem with the data submitted, or some pre-condition of the API call wasn't satisfied
	protected function failResponse($message = null, $code = 422){

		return response()->json($this->generalResponse('fail', $code, null ,$message = '', $data = null), $code);
	}

	protected function errorValidation($validator){

		$message = __('Error in fields validation');
		return response()->json($this->generalResponse('error', 422, $validator ,$message, $data = null), 422);
		//No 422, ele fala sobre erros de semântica. Ou seja, não tem erro de sintaxe, mas tem alguma informação faltando
	}

	protected function errorUnauthorized(){

		$error = __('Unauthorized');
		return response()->json($this->generalResponse('error', 401, $error, null, $data = null), 401);
	    //401 - Unauthorized 
	}

	private function generalResponse($status = 'success', $code = 200, $error = null, $message = null, $data = null){
		
		$output['status'] =  $status;
		$output['code'] =  $code;
		if($message) $output['message'] =  $message;
		if($error) $output['error'] =  $error;
		if($data) $output['data'] =  $data;
		$output['datetime'] = \Carbon\Carbon::now();
		return $output;
	}

	
}



// 400 Bad Request – This means that client-side input fails validation.
// 401 Unauthorized – This means the user isn’t not authorized to access a resource. It usually returns when the user isn’t authenticated.
// 403 Forbidden – This means the user is authenticated, but it’s not allowed to access a resource.
// 404 Not Found – This indicates that a resource is not found.
// 500 Internal server error – This is a generic server error. It probably shouldn’t be thrown explicitly.
// 502 Bad Gateway – This indicates an invalid response from an upstream server.
// 503 Service Unavailable – This indicates that something unexpected happened on server side (It can be anything like server overload, some parts of the system failed, etc.).