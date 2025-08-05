<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditGrant1 extends Migration
{
    public function up()
    {
        $fields = [
            'value'          => [
                'type'           => 'DECIMAL',
                'constraint'     => '25,2',
                'default' => 0.00,
                'null'           => true,
            ],
        ];

        $this->forge->modifyColumn('grant', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('grant', 'value'); 
    }
}