<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Entities\Account;
use App\Libraries\AccountService;
use CodeIgniter\API\ResponseTrait;

class RegisterApiController extends BaseController
{
  use ResponseTrait;

  public function register()
  {
    $data = $this->request->getJSON();

    // Campos obrigatórios
    $requiredFields = ['name', 'last_name', 'email', 'phone', 'date_of_birth', 'password', 'confirm_password'];
    foreach ($requiredFields as $field) {
      if (!isset($data->$field)) {
        return $this->failValidationErrors("O campo '{$field}' é obrigatório.");
      }
    }

    // Monta a entidade Account
    $account = (new Account())
      ->setEmail($data->email)
      ->setHolderName($data->name . ' ' . $data->last_name)
      ->setHolderDateOfBirth($data->date_of_birth)
      ->setHolderPhone($data->phone);

    try {
      $accountService = new AccountService();
      $userId = $accountService->createAccount($account, $data->password, $data->confirm_password);

      return $this->respondCreated([
        'success' => true,
        'userId'  => $userId,
        'message' => 'Usuário criado com sucesso. E-mail de verificação enviado.'
      ]);
    } catch (\RuntimeException $e) {
      // Se a exceção não tiver código HTTP válido, usa 400
      $code = in_array($e->getCode(), [400, 401, 403, 404, 409, 422, 500]) ? $e->getCode() : 400;
      return $this->fail($e->getMessage(), $code);
    } catch (\Throwable $e) {
      // Log detalhado do erro real
      log_message('error', '[RegisterApiController] ' . $e->getMessage() . "\n" . $e->getTraceAsString());

      return $this->failServerError('Ocorreu um erro interno ao processar seu cadastro. Por favor, tente novamente mais tarde.');
    }
  }
}
