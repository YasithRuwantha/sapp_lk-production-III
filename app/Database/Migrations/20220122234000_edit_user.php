<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditUser extends Migration
{
    public function up()
    {
        $fields = [
            'created_on'          => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'after' => 'language',
            ],
        ];

        $this->forge->addColumn('user', $fields);
    }

    public function down()
    {
        $this->forge->ddropColumn('user', 'created_on');
    }
}