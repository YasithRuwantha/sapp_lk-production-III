<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Editloan_disbursement1 extends Migration
{
    public function up()
    {
        $fields = [
            'remarks'          => [
                'type'           => 'TEXT',
                'comment' => '',
            ],
        ];

        $this->forge->addColumn('loan_disbursement', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('loan_disbursement', 'remarks');   
    }
}