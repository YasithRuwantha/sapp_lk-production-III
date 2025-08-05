<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditFarmer4 extends Migration
{
    public function up()
    {
        $fields = [
            'aggrarian_division_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Forign key aggrarian_division table',
            ],
        ];

        $this->forge->addField('CONSTRAINT FOREIGN KEY (aggrarian_division_id) REFERENCES aggrarian_division(id)');

        $this->forge->addColumn('farmer', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('farmer', 'aggrarian_division_id'); 
    }
}