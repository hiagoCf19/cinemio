<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Libraries\KeycloakService;
use CodeIgniter\API\ResponseTrait;

class LoginApiController extends BaseController
{
  use ResponseTrait;

  public function login()
  {
    try {
      // Pega o JSON enviado na requisição
      $data = $this->request->getJSON();

      // Verifica se o JSON veio correto
      if (!$data || !isset($data->email) || !isset($data->password)) {
        return $this->failValidationErrors("Parâmetros 'email' e 'password' são obrigatórios");
      }

      $email = $data->email;
      $password = $data->password;

      $keycloak = new KeycloakService();
      $response = $keycloak->login($email, $password);

      if (!$response['success']) {
        // Retorna erro com mensagem da API do Keycloak
        return $this->fail($response['message'] ?? 'Erro desconhecido', 401);
      }

      // Login bem-sucedido
      return $this->respond([
        'success' => true,
        'token'   => $response['token'],
      ], 200);
    } catch (\Exception $e) {
      // Qualquer outro erro inesperado
      return $this->failServerError("Erro interno: " . $e->getMessage());
    }
  }
}
