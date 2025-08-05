<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddlinkProjectTargetUser extends Migration
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
            'project_target_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer project_target table primary key',
            ],
            'user_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer user table primary key',
            ],
            'created_at'          => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at'          => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'deleted_at'          => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);

        $this->forge->addField('CONSTRAINT FOREIGN KEY (project_target_id) REFERENCES project_target(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (user_id) REFERENCES user(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('link_project_target_user');
    }

    public function down()
    {
        $this->forge->dropTable('link_project_target_user');
    }
}