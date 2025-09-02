<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateProfilesTable extends Migration
{
    public function up()
    {
        // Garante que a extensão UUID esteja habilitada
        $this->db->query('CREATE EXTENSION IF NOT EXISTS "uuid-ossp"');

        $this->forge->addField([
            'id' => [
                'type'    => 'UUID',
                'default' => new RawSql('uuid_generate_v4()'),
            ],
            'user_id' => [
                'type' => 'UUID',
                'null' => false,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'image_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'age' => [
                'type'       => 'INT',
                'constraint' => 3,
                'null'       => true,
            ],
            'user_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'unique'     => true,
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'accounts', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('profiles');

        // Default para timestamps
        $this->db->query('ALTER TABLE profiles ALTER COLUMN created_at SET DEFAULT CURRENT_TIMESTAMP;');
        $this->db->query('ALTER TABLE profiles ALTER COLUMN updated_at SET DEFAULT CURRENT_TIMESTAMP;');

        // Função trigger para atualizar `updated_at`
        $this->db->query("
            CREATE OR REPLACE FUNCTION update_profiles_updated_at()
            RETURNS TRIGGER AS \$\$
            BEGIN
                NEW.updated_at = CURRENT_TIMESTAMP;
                RETURN NEW;
            END;
            \$\$ language 'plpgsql';
        ");

        // Trigger
        $this->db->query("DROP TRIGGER IF EXISTS trigger_update_profiles_updated_at ON profiles;");
        $this->db->query("
            CREATE TRIGGER trigger_update_profiles_updated_at
            BEFORE UPDATE ON profiles
            FOR EACH ROW
            EXECUTE FUNCTION update_profiles_updated_at();
        ");
    }

    public function down()
    {
        $this->db->query("DROP TRIGGER IF EXISTS trigger_update_profiles_updated_at ON profiles;");
        $this->db->query("DROP FUNCTION IF EXISTS update_profiles_updated_at;");
        $this->forge->dropTable('profiles');
    }
}
