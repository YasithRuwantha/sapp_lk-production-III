<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditProjectTarget2 extends Migration
{
    public function up()
    {
        $fields = [
            'qty'               => [
                'type'          => 'INT',
                'constraint'    => 11,
                'null'           => true
            ],
            'target_amount'     => [
                'type'          => 'DECIMAL',
                'constraint'    => '25,2',
                'default'       => 0.00,
                'null'           => true
            ],
        ];

        $this->forge->modifyColumn('project_target', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('project_target', 'qty'); 
        $this->forge->dropColumn('project_target', 'target_amount'); 
    }
}