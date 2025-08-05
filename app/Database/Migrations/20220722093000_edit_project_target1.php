<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditProjectTarget1 extends Migration
{
    public function up()
    {
        $fields = [
            'no_of_farmers'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => true,
                'after' => 'target_amount',
                'comment' => 'number of grant item link should have lessthan this number',
            ],
        ];

        $this->forge->addColumn('project_target', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('project_target', 'no_of_farmers'); 
    }
}