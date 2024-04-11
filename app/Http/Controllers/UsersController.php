<?php

namespace App\Http\Controllers;

use Exception;
use Validator;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Traits\Requests\TestAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    use TestAuth ,ResponseTrait;

    function loginindex()
    {
        return view('login.login');
    }

    /**
     * @throws ValidationException
     */
    function login(Request $request)
    {
        //! validation
        $rules = $this->rulesLogin();
        $validator = $this->validate($request,$rules);
        if($validator !== true){return $validator;}

        $user_data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password')
        );

        if (!(Auth::attempt($user_data))) {
            return back()->with('error', 'Wrong Login Details');
        }
        else{return redirect('/alpum');}
        
    }

    /**
     * todo creating a new users resource.
     */
    public function regist()
    {
        //! validation
        $rules = $this->rulesComment();
        $validator = $this->validate($request,$rules);
        if($validator !== true){return $validator;}

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request ->lastname,
            'email'=> $request->email,
            'password'=> $request->password,
            'photo' => $request ->img
         ]);  
         

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
