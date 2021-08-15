<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    function upload(Request $request, $id){
        $user = User::find($id);
        if($user != null){
//            dd($request->all());
            if($request->hasfile('image')){
                $image =  $request->file('image')->store('uploads','public');
                return $user->update(['image'=>$image]);
                return response()->json(url('storage/'.$image));
            }else{
                return response()->json('image null');
            }
        }
        return response()->json("user not found");

    }
}
