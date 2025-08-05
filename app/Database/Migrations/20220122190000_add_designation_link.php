<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserDesignationLink extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'designation_id'          => [
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
            'is_delete'          => [
                'type'           => 'INT',
                'constraint'     => 1,
                'default' => 0,
                'comment' => '0-not deleted,1-deleted',
            ],
        ]);

        $this->forge->addField('CONSTRAINT FOREIGN KEY (user_id) REFERENCES user(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (designation_id) REFERENCES designation(id)');

        $this->forge->createTable('user_designation');
    }

    public function down()
    {
        $this->forge->dropTable('user_designation');
    }
}