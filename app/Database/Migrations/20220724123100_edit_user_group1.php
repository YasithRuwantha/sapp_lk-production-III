<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditUserGroup1 extends Migration
{
    public function up()
    {
        $fields = [
            'system_group'          => [
                'type'           => 'INT',
                'constraint'     => 1,
                'after' => 'group_name',
                'default'       => 0,
                'comment' => '0-default group, 1-system group',
            ],
        ];

        $this->forge->addColumn('user_group', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('user_group', 'system_group'); 
    }
}