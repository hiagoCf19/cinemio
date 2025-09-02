<?php


namespace App\Controllers\Home;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
  public function index()
  {
    $session = session();
    return view('home/selectProfile', ['session' => $session]);
  }
}
