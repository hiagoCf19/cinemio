<?php


namespace App\Controllers\Auth;



use App\Controllers\BaseController;
use App\Libraries\KeycloakService;

class LoginController extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }
    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $keycloak = new KeycloakService();
        $response = $keycloak->login($email, $password);

        if (!$response['success']) {
            // volta para a página anterior com mensagem de erro
            return redirect()->back()->with('error', $response['message'] ?? 'Credenciais inválidas');
        }

        // se sucesso, salva o token na sessão (se quiser)
        session()->set('token', $response['token']);

        // redireciona para home
        return redirect()->to('/');
    }
}
