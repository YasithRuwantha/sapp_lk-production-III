<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserTypeLink extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'type_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'start_on'          => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'default' => 1,
            ],
            'end_on'          => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'default' => 3851405551,
            ],
        ]);

        $this->forge->addField('CONSTRAINT FOREIGN KEY (user_id) REFERENCES user(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (type_id) REFERENCES user_type(id)');

        $this->forge->createTable('user_type_link');
    }

    public function down()
    {
        $this->forge->dropTable('user_type_link');
    }
}