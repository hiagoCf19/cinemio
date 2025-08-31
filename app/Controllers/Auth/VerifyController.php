<?php

namespace App\Controllers\Auth;

use App\Libraries\AccountService;
use CodeIgniter\Controller;

class VerifyController extends Controller
{
  public function verify()
  {
    $uid = $this->request->getGet('uid'); // pega o uid da query string

    if (!$uid) {
      return redirect()->to('/login')->with('error', 'Usuário inválido.');
    }

    try {
      $accountService = new AccountService();
      $accountService->verifyEmail($uid); // marca email como verificado no banco
    } catch (\Throwable $e) {
      log_message('error', '[EmailController] ' . $e->getMessage());
      // mesmo se der erro, redireciona para login
      return redirect()->to('/login')->with('error', 'Não foi possível verificar o email.');
    }

    // redireciona para login após verificação
    return redirect()->to('/login')->with('success', 'Email verificado com sucesso!');
  }
}
