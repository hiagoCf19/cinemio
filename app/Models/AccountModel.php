<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Account;

class AccountModel extends Model
{
  protected $table = 'accounts';
  protected $primaryKey = 'id';
  protected $returnType = 'array'; // ou 'App\Entities\Account' se quiser Entity nativa do CI4
  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $allowedFields = [
    'id',
    'email',
    'external_id',
    'holder_name',
    'holder_date_of_birth',
    'holder_phone',
    'active',
    'is_email_verified',
    'created_at',
    'updated_at'
  ];

  public function insertAccount(Account $account)
  {
    // Converte para array e insere
    $this->insert($account->toArray());
  }
}
