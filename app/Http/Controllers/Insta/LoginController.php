<?php


namespace App\Http\Controllers\Insta;


use App\Http\Controllers\Controller;

class LoginController extends Controller {

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('dash.home');
    }
}
