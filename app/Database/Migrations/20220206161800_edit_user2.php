<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditUser2 extends Migration
{
    public function up()
    {
        $fields = [
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
        ];

        $this->forge->addColumn('user', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('user', 'created_at');
        $this->forge->dropColumn('user', 'updated_at');
        $this->forge->dropColumn('user', 'deleted_at');
    }
}