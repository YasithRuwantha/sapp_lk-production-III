<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRegion extends Migration
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
            'label'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
            ],
            'is_delete'          => [
                'type'           => 'INT',
                'constraint'     => 1,
                'default' => 0,
                'comment' => '0-not deleted,1-deleted',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('region');
    }

    public function down()
    {
        $this->forge->dropTable('region');
    }
}