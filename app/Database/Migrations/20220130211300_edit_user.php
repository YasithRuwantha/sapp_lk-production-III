<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditUser1 extends Migration
{
    public function up()
    {
        $fields = [
            'user_type'          => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'after' => 'language',
                'comment' => 'Refer config table number 6',
            ],
        ];

        $this->forge->addColumn('user', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('user', 'user_type');
    }
}