<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Libraries\KeycloakService;
use CodeIgniter\API\ResponseTrait;

class RegisterApiController extends BaseController
{
  use ResponseTrait;

  public function register()
  {
    try {
      // Pega o JSON enviado na requisição
      $data = $this->request->getJSON();

      // Verifica se todos os campos obrigatórios vieram
      $requiredFields = ['nome', 'sobrenome', 'email', 'telefone', 'data_nascimento', 'password', 'confirm_password'];
      foreach ($requiredFields as $field) {
        if (!isset($data->$field)) {
          return $this->failValidationErrors("O campo '{$field}' é obrigatório.");
        }
      }

      $keycloak = new KeycloakService();

      // Cria o usuário no Keycloak
      $userId = $keycloak->createAccount([
        'nome'             => $data->nome,
        'sobrenome'        => $data->sobrenome,
        'email'            => $data->email,
        'telefone'         => $data->telefone,
        'data_nascimento'  => $data->data_nascimento,
        'password'         => $data->password,
        'confirm_password' => $data->confirm_password,
      ]);

      // Envia e-mail de verificação
      // $keycloak->sendVerificationEmail($userId);

      // Retorna sucesso
      return $this->respond([
        'success' => true,
        'userId'  => $userId,
        'message' => 'Usuário criado com sucesso. E-mail de verificação enviado.'
      ], 201);
    } catch (\Exception $e) {
      // Qualquer outro erro inesperado
      return $this->failServerError("Erro interno: " . $e->getMessage());
    }
  }
}
