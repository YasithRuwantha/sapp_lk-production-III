<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLinkProjectGnd extends Migration
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
            'project_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer project table primary key',
            ],           
            'gnd_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer gnd table primary key',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (project_id) REFERENCES project(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (gnd_id) REFERENCES gnd(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('link_project_gnd');
    }

    public function down()
    {
        $this->forge->dropTable('link_project_gnd');
    }
}