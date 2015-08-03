<?php

/*
* Manage Users for API endpoints
*/
class UserController extends BaseController {
    /*
     * Authenticates a user and sets the session if successful.
     * @return \Illuminate\Http\JsonResponse
    */
    public function authenticate() {           
        //Auth::logout();       
        
        // login & remember user if required
        $email = Request::get('email');
        $password = Request::get('password');
        if (Auth::validate(['email' => $email, 'password' => $password])){
            $user = User::whereEmail(Input::get('email'))->first();
            
            if (Auth::attempt(Input::all())) {
                $data = Auth::user()->toArray();
                
                return Response::json(array(
                    'error' => false,
                    'user' => $data),
                    200
                );
            }
        }
        
        // invalid 
        return Response::json(array(
            'error' => true,
            'message' => 'Invalid email or password.'),
            200
        );        
    }
}  
?>
