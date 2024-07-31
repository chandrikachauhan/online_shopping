<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\facades\DB;
use Illuminate\support\facades\validator;

class loginController extends Controller
{
    public function index()
    {
        if(session('email')){
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }
    public function create(Request $request)
    {
       $validatior = validator::make($request->all(),
       [
        'email' => 'required|email',
        'password'=>'required'
       ]
       );
        // $validatior = $request->validate([
        //     'email'=>'required|email',
        //     'password' =>'required'
        // ]);
       if($validatior->passes()){
            $record = DB::table('admin')
            ->where('email','=',$request->email)
            ->where('password','=',$request->password)
            ->get();
            if($record->isNotEmpty())
            {
                session()->put('email',$request->email);
                return redirect()->route('admin.dashboard');
            }
            else{
                return redirect()->route('admin.login')->with(['messages'=>"Email and Password  Are Not Match"]);
            }
        }
        else{
            return redirect()->back()->withErrors($validatior->errors())->withInput();
        
        }
    }
    public function logout()
    {
        session()->forget('email');
        return redirect()->route('admin.login');
    }
}
