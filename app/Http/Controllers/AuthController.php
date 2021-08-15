<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Skill;
use Illuminate\Http\Request;


class AuthController extends Controller
{


    public function register(Request $request){
        $fields = $request->validate ([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users'],
             'password' => ['string','min:8'],
           'phone_number' => ['required','min:11','string'],
            'national_id' => ['required','min:11','string'],
            'username' => ['required', 'string','min:4', 'max:50'],
            'city' => ['required', 'string','min:4', 'max:50'],
            'street' => ['required', 'string','min:4', 'max:50'],
            'overview' => ['string','nullable','min:25'],
            'gender' =>'in:male,female',
            'type' =>'in:developer,client',
            'university' => ['required', 'string', 'max:255'],
            'specialization' => ['required', 'string', 'max:255'],
            'experience' => ['string','nullable','min:25' ],
            'category_id'=>['exists:categories,id']
        ]);

        $user = new User();
        $user->fname = $fields['fname'];
        $user->lname = $fields['lname'];
        $user->email = $fields['email'];
        $user->password = Hash::make($fields['password']);
        $user->phone_number =$fields[ 'phone_number'];
        $user->national_id =  $fields['national_id'];
        $user->username = $fields['username'];
        $user->city =  $fields['city'];
        $user->street =$fields['street'];
        $user->gender = $fields['gender'];
        $user->type =$fields['type'];
        $user->university = $fields['university'];
        $user->specialization =  $fields['specialization'];
        if ($request->has('overview'))
        {
            $user->overview =$fields[ 'overview'];
        }
        if ($request->has('experience'))
        {
            $user->experience = $fields['experience'];
        }
        if ($request->has('category_id'))
        {
            $user->category_id = $fields['category_id'];
        }

        $user->save();

        $token =$user->createToken("usertoken")->plainTextToken;

        $response=[
            'user' =>$user ,
            'token' =>$token
        ];

        return  response( $response ,201);

   }


    public function login(Request $request){
        $fields = $request->validate ([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user=User::where('email', $fields['email'])->first();
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message'=>"Unauthorised"
            ],401);

        }


        $token =$user->createToken("usertoken")->plainTextToken;

        $response=[
            'user' =>$user ,
            'token' =>$token
        ];

        return  response( $response ,201);

    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response(
            ['message'=>"Logged Out"]
        ,201);
    }



}
