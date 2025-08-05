<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditFarmer5 extends Migration
{
    public function up()
    {
        $fields = [
            'undergo_training'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 256,
                'after' => 'expense_other',
                'comment' => '',
            ],
        ];

        $this->forge->modifyColumn('farmer', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('farmer', 'undergo_training'); 
    }
}