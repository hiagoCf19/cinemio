<?php

namespace App\Controllers\landing;

use App\Controllers\BaseController;

class LandingPageController extends BaseController
{
    public function index()
    {
        return view('landing/landingPage');
    }
}