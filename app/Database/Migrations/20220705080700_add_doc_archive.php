<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDocArchive extends Migration
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
            'category'    => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'comment' => 'Config 56',
            ],
            'project_id'         => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Forign key project table',
            ],
            'description'        => [
                'type'           => 'TEXT',
                'null'           => true,
                'comment'        => '',
            ],
            'uploaded_by'        => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Forign key user table',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (uploaded_by) REFERENCES user(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (project_id) REFERENCES project(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('doc_archive');
    }

    public function down()
    {
        $this->forge->dropTable('doc_archive');
    }
}