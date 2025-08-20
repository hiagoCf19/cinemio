<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class TestDB extends Controller
{
  public function index()
  {
    $db = Database::connect();
    $query = $db->query("SELECT current_database() as db, NOW() as agora");
    $result = $query->getRow();

    echo "Conectado ao banco: {$result->db} <br>";
    echo "Hora do servidor: {$result->agora}";
  }
}
