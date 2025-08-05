<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDesignation extends Migration
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
            'designation'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
                'comment' => 'Project Director, Project Coordinator, Promoter',
            ],
            'designation_category'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
                'comment' => 'Staff / Partner / Benificiary',
            ],
            'is_delete'          => [
                'type'           => 'INT',
                'constraint'     => 1,
                'default' => 0,
                'comment' => '0-not deleted,1-deleted',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('designation');
    }

    public function down()
    {
        $this->forge->dropTable('designation');
    }
}