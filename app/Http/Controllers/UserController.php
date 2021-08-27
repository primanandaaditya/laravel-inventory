<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function Ramsey\Uuid\v1;

class UserController extends Controller
{
    public function index(){
        return view('master/user/index');
    }
}
