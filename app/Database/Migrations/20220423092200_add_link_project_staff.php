<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLinkProjectStaff extends Migration
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
            'user_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer user table primary key',
            ],  
            'role'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => '{"1":"VCM", "2":"RPC", "3":"PMU Support Staff", "4":"Consultant"}',
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
        $this->forge->addField('CONSTRAINT FOREIGN KEY (user_id) REFERENCES user(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('link_project_staff');
    }

    public function down()
    {
        $this->forge->dropTable('link_project_staff');
    }
}