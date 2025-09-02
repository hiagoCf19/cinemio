<?php

namespace App\Libraries;

use App\Entities\Account;

class AccountService
{
  public function __construct() {}
  public function createAccount(Account $account, $password, $confirmPassword): string
  {
    $keycloak = new KeycloakService();
    $names = explode(' ', $account->getHolderName(), 2);
    $firstName = $names[0] ?? '';
    $lastName  = $names[1] ?? '';

    try {
      $externalId = $keycloak->createAccount([
        'name' => $firstName,
        'last_name' => $lastName,
        'email' => $account->getEmail(),
        'phone' => $account->getHolderPhone(),
        'date_of_birth' => $account->getHolderDateOfBirth(),
        'password' => $password,
        'confirm_password' => $confirmPassword,
      ]);
    } catch (\Throwable $e) {
      $code = $e->getCode() ?: 500;
      echo $e;
      throw new \RuntimeException('Erro ao criar usuário no Keycloak.', $code, $e);
    }

    // Salva no banco local
    $db = \Config\Database::connect();
    $builder = $db->table('accounts');

    $dataToInsert = $account->toArray();

    // Gera UUID para o id se ainda não existir
    if (empty($dataToInsert['id'])) {
      $dataToInsert['id'] = bin2hex(random_bytes(16)); // UUID v4 simplificado
    }

    $dataToInsert['external_id'] = $externalId;

    $builder->insert($dataToInsert);

    // Retorna o id que foi inserido (não depende de insertID)
    return $dataToInsert['id'];
  }
  public function verifyEmail(string $uid): void
  {
    $db = \Config\Database::connect();
    $builder = $db->table('accounts');

    // Atualiza o usuário com o external_id = $uid
    $builder->where('id', $uid)
      ->update(['is_email_verified' => true]);
  }
  public function getProfiles(string $user_id)
  {
    $db = \Config\Database::connect();

    // Usando Query Builder direto
    $builder = $db->table('profiles');
    $builder->where('user_id', $user_id);
    $query = $builder->get();

    return $query->getResult(); // retorna array de objetos
  }
}
