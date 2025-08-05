<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStats extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'date_time'          => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
            'user_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'default' => 0,
            ],
            'header'          => [
                'type'           => 'TEXT',
                'null'           => true,
            ],            
            'session'          => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'post'          => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
        ]);

        $this->forge->addField('CONSTRAINT FOREIGN KEY (user_id) REFERENCES user(id)');
        $this->forge->createTable('stats');
    }

    public function down()
    {
        $this->forge->dropTable('stats');
    }
}