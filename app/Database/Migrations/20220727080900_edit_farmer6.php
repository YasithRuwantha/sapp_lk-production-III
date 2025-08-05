<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditFarmer6 extends Migration
{
    public function up()
    {
        $fields = [
            'source_of_credit'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
                'after' => 'before_barrow',
                'comment' => '',
            ],
        ];

        $this->forge->modifyColumn('farmer', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('farmer', 'source_of_credit'); 
    }
}