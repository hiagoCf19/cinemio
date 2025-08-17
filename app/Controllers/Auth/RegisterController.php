<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Libraries\KeycloakService;


class RegisterController extends BaseController
{
  public function index()
  {
    return view('auth/register');
  }
  public function register()
  {
    // Pegando todos os valores enviados pelo form
    $nome            = $this->request->getPost('nome');
    $sobrenome       = $this->request->getPost('sobrenome');
    $email           = $this->request->getPost('email');
    $telefone        = $this->request->getPost('telefone');
    $password        = $this->request->getPost('password');
    $confirmPassword = $this->request->getPost('confirm_password');

    // Exibindo no navegador (só para teste)
    echo "Nome: " . $nome . "<br>";
    echo "Sobrenome: " . $sobrenome . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Telefone: " . $telefone . "<br>";
    echo "Senha: " . $password . "<br>";
    echo "Confirmação de Senha: " . $confirmPassword . "<br>";
  }
}
