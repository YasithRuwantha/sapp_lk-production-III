<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserType extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'role_name'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('user_type');
    }

    public function down()
    {
        $this->forge->dropTable('user_type');
    }
}