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

        // se login no Keycloak foi bem-sucedido, pega os dados no banco
        $db = \Config\Database::connect();
        $builder = $db->table('accounts');
        $account = $builder->where('email', $email)->get()->getRowArray();

        if (!$account) {
            return redirect()->back()->with('error', 'Usuário não encontrado no sistema.');
        }

        // salva os dados do usuário na sessão
        session()->set([
            'user_id'           => $account['id'],
            'email'             => $account['email'],
            'external_id'       => $account['external_id'],
            'holder_name'       => $account['holder_name'],
            'holder_date_of_birth' => $account['holder_date_of_birth'],
            'holder_phone'      => $account['holder_phone'],
            'active'            => $account['active'],
            'is_email_verified' => $account['is_email_verified'],
            'created_at'        => $account['created_at'],
            'updated_at'        => $account['updated_at'],
            'token'             => $response['token'] // opcional
        ]);

        // redireciona para home
        return redirect()->to('/');
    }
}
