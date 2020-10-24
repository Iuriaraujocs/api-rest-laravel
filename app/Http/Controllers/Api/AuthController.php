<?php

namespace App\Http\Controllers\Api;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;

class AuthController extends ApiController
{
    
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function Login(){
        
        $rules = [
            'email' => 'email|required',
            'password' => 'required'
        ]; 

        $validator = Validator::make($this->request->all(),$rules);

        if ($validator->fails()) {
            return $this->errorValidation($validator->errors());
        }

        $credentials = $this->request->only('email', 'password');

        if (!Auth::attempt($credentials)) { 
            return $this->errorUnauthorized();
            //401 - Unauthorized 
        }
        else {
            // Authentication passed...
            $user = User::select('id','name','email','api_token')->where('id',Auth::id())->first();
            
            if(!empty($user))
            {
                $output['user'] = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ];
                
                $output['api_token'] = $user->api_token;
               
                return $this->loginSuccessfully($output);
            }
        }
    }

    public function Register(){
    
        $rules = [
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
            //password_confirmation
        ]; 


        $validator = Validator::make($this->request->all(),$rules);

        if ($validator->fails()) {
            return $this->errorValidation($validator->errors());
        }
        
        else{
            $user = User::forceCreate([
                'name' => $this->request->name,
                'email' => $this->request->email,
                'password' => Hash::make($this->request->password),
                'api_token' => Str::random(80),
                'api_token_created_at' => Carbon::now()//date('Y-m-d H:i:s')
            ]);

            if(!empty($user)){
                $output['user'] = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ];
                $output['api_token'] = $user->api_token;
                return $this->registerSuccessfully($output);
                
            }
        }

    }

    public function forgotPassword(){

        $credentials = request()->validate(['email' => 'required|email']);

        Password::sendResetLink($credentials);

        return $this->forgotSuccessfully();
    
    }


    private function loginSuccessfully($output){
        $message = 'Login was successfully. Please, use the api_token for future access.';
        return $this->successResponse($output, $message);
    }

    private function registerSuccessfully($output){
        $message = 'Register successfully';
        return $this->successResponse($output,$message, 201);
        //201 Created — Indica que a requisição foi bem sucedida e que um novo registro foi criado como resultado.        
    }

    private function forgotSuccessfully(){
        $message = 'Reset password link sent on your email id.';
        return $this->successResponse(null,$message);
    }

}


//https://medium.com/@panjeh/laravel-get-bearer-token-from-a-request-b1b242277e22       request->bearerToken
//https://rafaell-lycan.com/2016/construindo-restful-api-laravel-parte-3/       com jwt
//https://www.twilio.com/blog/build-secure-api-php-laravel-passport
//https://medium.com/techcompose/create-rest-api-in-laravel-with-authentication-using-passport-133a1678a876


// Auth::login($user, TRUE);    user that is extended authenticable
// or
//Auth::loginUsingId($user->id, TRUE);