<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditGrantDisbursement1 extends Migration
{
    public function up()
    {
        $fields = [
            'farmer_category'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => true,
                'after' => 'id',
                'comment' => 'Refer project_target table primary key',
            ],
        ];

        $this->forge->addField('CONSTRAINT FOREIGN KEY (farmer_category) REFERENCES project_target(id)');
        $this->forge->addColumn('grant_disbursement', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('grant_disbursement', 'civil_status'); 
    }
}