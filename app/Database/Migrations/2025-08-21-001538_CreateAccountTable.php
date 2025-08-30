<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateAccountTable extends Migration
{
    public function up()
    {
        // Ativa a extensão para gerar UUIDs no PostgreSQL, caso não esteja ativa.
        $this->db->query('CREATE EXTENSION IF NOT EXISTS "uuid-ossp"');

        // Define os campos da tabela 'accounts'
        $this->forge->addField([
            'id' => [
                'type'       => 'UUID',
                'primary'    => true, // Define como chave primária diretamente aqui
                'default'    => new RawSql('uuid_generate_v4()'),
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'unique'     => true,
            ],
            'external_id' => [
                'type'       => 'UUID',
                'null'       => false,
            ],
            'holder_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'holder_date_of_birth' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'holder_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'active' => [
                'type'       => 'BOOLEAN',
                'default'    => true,
            ],
            'is_email_verified' => [
                'type'       => 'BOOLEAN',
                'default'    => false,
            ],
            'created_at' => [
                'type'       => 'TIMESTAMP',
                'null'       => true,
            ],
            'updated_at' => [
                'type'       => 'TIMESTAMP',
                'null'       => true,
            ],
        ]);

        // Define a chave primária
        $this->forge->addPrimaryKey('id');

        // Cria a tabela
        $this->forge->createTable('accounts');
    }

    public function down()
    {
        // Deleta a tabela 'accounts'
        $this->forge->dropTable('accounts');
    }
}
