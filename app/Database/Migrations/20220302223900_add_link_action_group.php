<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLinkActionGroup extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'group_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'action_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
        ]);

        $this->forge->addField('CONSTRAINT FOREIGN KEY (action_id) REFERENCES module_action(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (group_id) REFERENCES user_group(id)');

        $this->forge->addKey('action_id', true);
        $this->forge->addKey('group_id', true);

        $this->forge->createTable('link_action_group');
    }

    public function down()
    {
        $this->forge->dropTable('link_action_group');
    }
}