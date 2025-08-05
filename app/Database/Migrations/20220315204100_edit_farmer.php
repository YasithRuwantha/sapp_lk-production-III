<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditFarmer1 extends Migration
{
    public function up()
    {
        $fields = [
            'gnd_id'          => [
                'type'           => 'INT',
                'null'           => true,
                'unsigned'       => true,
            ],
        ];

        $this->forge->addField('CONSTRAINT FOREIGN KEY (gnd_id) REFERENCES gnd(id)');
        $this->forge->addColumn('farmer', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('farmer', 'gnd_id');
    }
}