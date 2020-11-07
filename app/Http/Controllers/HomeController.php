<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{

  public function home(){

    $message=[
      'name'=>'Some Custom Value passed',
  ];
  //Custom Channel For Logging in Json Format
  Log::channel('LogsInJson')->info('User Landed On Home page',$message);


  return view('welcome');

  }
  
}
