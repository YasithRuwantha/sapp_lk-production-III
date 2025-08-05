<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNscPaper extends Migration
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
            'nsc_meeting_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer nsc_meeting table primary key',
            ],
            'nsc_paper_no'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null'           => true,
                'comment' => '',
            ],
            'subject'          => [
                'type'           => 'TEXT',
                'null'           => true,
                'comment' => '',
            ],
            'matter_discussed'          => [
                'type'           => 'TEXT',
                'null'           => true,
                'comment' => '',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (nsc_meeting_id) REFERENCES nsc_meeting(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('nsc_paper');
    }

    public function down()
    {
        $this->forge->dropTable('nsc_paper');
    }
}