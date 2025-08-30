<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Entities\Account;
use App\Libraries\AccountService;
use CodeIgniter\API\ResponseTrait;

class RegisterController extends BaseController
{
  use ResponseTrait;
  public function index()
  {
    return view('auth/register');
  }

  public function register()
  {
    // Pega os dados do formulário
    $data = $this->request->getPost();


    // Campos obrigatórios
    $requiredFields = ['name', 'last_name', 'email', 'phone', 'date_of_birth', 'password', 'confirm_password'];
    foreach ($requiredFields as $field) {
      if (empty($data[$field])) {
        return $this->failValidationErrors("O campo '{$field}' é obrigatório.");
      }
    }

    // Monta a entidade Account
    $account = (new Account())
      ->setEmail($data['email'])
      ->setHolderName($data['name'] . ' ' . $data['last_name'])
      ->setHolderDateOfBirth($data['date_of_birth'])
      ->setHolderPhone($data['phone']);

    try {
      $accountService = new AccountService();
      $accountService->createAccount($account, $data['password'], $data['confirm_password']);

      // Renderiza view informando que precisa confirmar e-mail
      return view('auth/verify-email', [
        'email' => $data['email'],
        'message' => 'Cadastro realizado com sucesso! Verifique seu e-mail para ativar sua conta.'
      ]);
    } catch (\RuntimeException $e) {
      $code = in_array($e->getCode(), [400, 401, 403, 404, 409, 422, 500]) ? $e->getCode() : 400;
      return $this->fail($e->getMessage(), $code);
    } catch (\Throwable $e) {
      log_message('error', '[RegisterController] ' . $e->getMessage() . "\n" . $e->getTraceAsString());
      return $this->failServerError('Ocorreu um erro interno ao processar seu cadastro. Por favor, tente novamente mais tarde.');
    }
  }
}
