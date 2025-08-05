<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLinkUserGroup extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'group_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'user_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'start_at'          => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'end_at'          => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);

        $this->forge->addField('CONSTRAINT FOREIGN KEY (user_id) REFERENCES user(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (group_id) REFERENCES user_group(id)');

        $this->forge->addKey('user_id', true);
        $this->forge->addKey('group_id', true);

        $this->forge->createTable('link_user_group');
    }

    public function down()
    {
        $this->forge->dropTable('link_user_group');
    }
}