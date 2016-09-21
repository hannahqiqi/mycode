<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    
    public function index() {
        
        return view('login');
        
    }
    
    public function land(Request $request) {
        
        $username = $request->input('username');
        $password = $request->input('password');
        
        $results = DB::select(" SELECT * FROM login WHERE user = '$username' and password='$password' ");
        if($results) {
            $request->session()->put('user', $username);
            return view('success');
        } else {
            return view('login', ['username' => $username, 'password' => $password]);
        }
        
    }
    
}