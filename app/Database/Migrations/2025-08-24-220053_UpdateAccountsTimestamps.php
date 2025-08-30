<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateAccountsTimestamps extends Migration
{
    public function up()
    {
        // Default para timestamps
        $this->db->query('ALTER TABLE accounts ALTER COLUMN created_at SET DEFAULT CURRENT_TIMESTAMP;');
        $this->db->query('ALTER TABLE accounts ALTER COLUMN updated_at SET DEFAULT CURRENT_TIMESTAMP;');

        // Função trigger
        $this->db->query("
            CREATE OR REPLACE FUNCTION update_updated_at_column()
            RETURNS TRIGGER AS \$\$
            BEGIN
                NEW.updated_at = CURRENT_TIMESTAMP;
                RETURN NEW;
            END;
            \$\$ language 'plpgsql';
        ");

        // Trigger
        $this->db->query("DROP TRIGGER IF EXISTS trigger_update_updated_at ON accounts;");
        $this->db->query("
            CREATE TRIGGER trigger_update_updated_at
            BEFORE UPDATE ON accounts
            FOR EACH ROW
            EXECUTE FUNCTION update_updated_at_column();
        ");
    }

    public function down()
    {
        $this->db->query("DROP TRIGGER IF EXISTS trigger_update_updated_at ON accounts;");
        $this->db->query("DROP FUNCTION IF EXISTS update_updated_at_column();");
        $this->db->query('ALTER TABLE accounts ALTER COLUMN created_at DROP DEFAULT;');
        $this->db->query('ALTER TABLE accounts ALTER COLUMN updated_at DROP DEFAULT;');
    }
}
