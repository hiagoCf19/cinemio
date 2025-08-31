<?php


namespace App\Controllers\Home;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
  public function index()
  {
    $session = session();

    // Para debug: mostra todos os dados da sessão
    print_r($session->get());
    echo '</pre>';
  }
}
