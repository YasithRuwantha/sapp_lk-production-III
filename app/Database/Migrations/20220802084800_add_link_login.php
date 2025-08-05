<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLinkLogin extends Migration
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
            'user_id'            => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Forign key user table',
            ],
            'pass_code'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null'           => true,
            ],
            'created_at'         => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at'         => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'deleted_at'         => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);

        $this->forge->addField('CONSTRAINT FOREIGN KEY (user_id) REFERENCES user(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('link_login');
    }

    public function down()
    {
        $this->forge->dropTable('link_login');
    }
}