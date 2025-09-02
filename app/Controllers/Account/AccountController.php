<?php


namespace App\Controllers\Auth;



use App\Controllers\BaseController;
use App\Libraries\AccountService;

class AccountController extends BaseController
{

  public function getProfiles()
  {
    $user_id = $this->request->getPost('user_id');


    $account = new AccountService();
    $response = $account->getProfiles($user_id);


    if (!$response['success']) {
      // volta para a página anterior com mensagem de erro
      return redirect()->back()->with('error', $response['message'] ?? 'Erro ao obter perfis');
    }
    // salva os dados do usuário na sessão

    return $response;
  }
}
