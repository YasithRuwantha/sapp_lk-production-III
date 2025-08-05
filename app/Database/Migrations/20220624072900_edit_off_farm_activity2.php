<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Edit_off_farm_activity2 extends Migration
{
    public function up()
    {
        $fields = [
            'off_farm_activity_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'comment' => 'Refer off_farm_activity table primary key',
                'after' => 'off_farm_development_id',
            ],
        ];

        $this->forge->addField('CONSTRAINT FOREIGN KEY (off_farm_activity_id) REFERENCES off_farm_activity(id)');

        $this->forge->addColumn('off_farm_payment', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('off_farm_payment', 'off_farm_activity_id');
    }
}