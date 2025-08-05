<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLinkNscPaperFile extends Migration
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
            'nsc_paper_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer nsc_meeting table primary key',
            ],
            'file_id'          => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'comment' => 'Refer file_registry table primary key',
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

        $this->forge->addField('CONSTRAINT FOREIGN KEY (nsc_paper_id) REFERENCES nsc_paper(id)');
        $this->forge->addField('CONSTRAINT FOREIGN KEY (file_id) REFERENCES file_registry(id)');

        $this->forge->addKey('id', true);
        $this->forge->createTable('link_nsc_paper_file');
    }

    public function down()
    {
        $this->forge->dropTable('link_nsc_paper_file');
    }
}