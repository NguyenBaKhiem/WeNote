<?php

namespace App\Http\Controllers;

use App\Consts;
use App\User;
use App\Utils;
// use App\Http\Services\MasterdataService;
// use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Auth;
use Cache;
use DB;
use Exception;
use Log;
use Crypt;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('app.app');
    }

}
